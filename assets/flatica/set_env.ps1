# set_env.ps1
# -----------------------------------------------------------------------
#
#      . .\set_env.ps1
#
# -----------------------------------------------------------------------

$env:SMTP_HOST     = "mail.hosting.reg.ru"
$env:SMTP_PORT     = "465"
$env:SMTP_USER     = ""
$env:SMTP_PASSWORD = ""
Write-Host "OK: environment variables set for this PowerShell session." -ForegroundColor Green
Write-Host "SMTP_USER = $env:SMTP_USER"
