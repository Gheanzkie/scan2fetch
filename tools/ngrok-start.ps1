<#
    Scan2Fetch - public tunnel starter (ngrok)

    Usage:
        .\ngrok-start.ps1                 # tunnel the local port (default 8080)
        .\ngrok-start.ps1 -Port 80        # tunnel Apache on port 80
        .\ngrok-start.ps1 -Port 8080 -Domain your-name.ngrok-free.dev

    Why the tunnel "works for me but not for them":
      * free ngrok gives a NEW random subdomain every restart - an old link is
        dead for everyone else (browser shows DNS_PROBE_FINISHED_NXDOMAIN);
      * some ISPs / school networks block *.ngrok-free.app - a claimed static
        domain on *.ngrok-free.dev usually resolves fine;
      * a tunnel that is not running returns "This site can't be reached".

    So: claim ONE free static domain in the ngrok dashboard and always reuse it.
#>

param(
    [int]    $Port   = 8080,
    [string] $Domain = "",
    [string] $Ngrok  = "ngrok"
)

$ErrorActionPreference = "Stop"

# ---------- locate the ngrok binary ----------
$candidates = @(
    $Ngrok,
    "$env:LOCALAPPDATA\ngrok\ngrok.exe",
    "$env:ProgramFiles\ngrok\ngrok.exe",
    "C:\ngrok\ngrok.exe",
    "C:\xampp\ngrok\ngrok.exe"
)

$binary = $null
foreach ($c in $candidates) {
    if ([string]::IsNullOrWhiteSpace($c)) { continue }
    if (Test-Path $c) { $binary = $c; break }
    $cmd = Get-Command $c -ErrorAction SilentlyContinue
    if ($cmd) { $binary = $cmd.Source; break }
}

if (-not $binary) {
    Write-Host "[BLOCKED] ngrok.exe not found." -ForegroundColor Red
    Write-Host "          Install it once:  winget install --id Ngrok.Ngrok" -ForegroundColor Yellow
    Write-Host "          Then:             ngrok config add-authtoken <YOUR_TOKEN>" -ForegroundColor Yellow
    exit 1
}

Write-Host "[RECON] using $binary" -ForegroundColor Cyan

# ---------- is anything listening on the port? ----------
$listening = Get-NetTCPConnection -State Listen -LocalPort $Port -ErrorAction SilentlyContinue
if (-not $listening) {
    Write-Host "[BLOCKED] nothing is listening on port $Port." -ForegroundColor Red
    Write-Host "          start the app first, e.g.  php spark serve --port $Port" -ForegroundColor Yellow
    Write-Host "          (or use -Port 80 for XAMPP Apache)" -ForegroundColor Yellow
}

# ---------- auth token present? ----------
$yml = "$env:LOCALAPPDATA\ngrok\ngrok.yml"
if (-not (Test-Path $yml)) {
    Write-Host "[BLOCKED] no ngrok config at $yml" -ForegroundColor Red
    Write-Host "          run: ngrok config add-authtoken <YOUR_TOKEN>" -ForegroundColor Yellow
    exit 1
}

# ---------- start the tunnel ----------
$args = @("http", "$Port", "--log=stdout", "--log-format=json")

if ($Domain -ne "") {
    $args += "--domain=$Domain"
    $args += "--host-header=rewrite"
    Write-Host "[RECON] static domain: $Domain" -ForegroundColor Cyan
} else {
    $args += "--host-header=rewrite"
    Write-Host "[WARN] no -Domain given: this URL changes on every restart and old links stop resolving." -ForegroundColor Yellow
}

Write-Host "[EXEC] $binary $($args -join ' ')" -ForegroundColor Green
$proc = Start-Process -FilePath $binary -ArgumentList $args -PassThru -WindowStyle Hidden

# ---------- read the public URL from the local API ----------
$url = $null
for ($i = 0; $i -lt 20; $i++) {
    Start-Sleep -Milliseconds 500
    try {
        $info = Invoke-RestMethod -Uri "http://127.0.0.1:4040/api/tunnels" -TimeoutSec 2
        $url  = ($info.tunnels | Where-Object { $_.proto -eq "https" } | Select-Object -First 1).public_url
        if ($url) { break }
    } catch { }
}

if (-not $url) {
    Write-Host "[BLOCKED] tunnel did not report a public URL. Check ngrok output." -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "  PUBLIC URL : $url" -ForegroundColor Green
Write-Host "  LOCAL APP  : http://localhost:$Port/" -ForegroundColor DarkGray
Write-Host ""
Write-Host "  * share the https link exactly as printed" -ForegroundColor Gray
Write-Host "  * keep this window / tunnel running - closing it kills the link" -ForegroundColor Gray
Write-Host "  * first visit may show the ngrok warning page - click 'Visit Site'" -ForegroundColor Gray

try { Set-Clipboard -Value $url } catch { }
Write-Host "  (URL copied to clipboard)" -ForegroundColor DarkGray

Write-Host ""
Write-Host "  stop: Stop-Process -Id $($proc.Id)" -ForegroundColor DarkGray
