@IF EXIST "%~dp0\node.exe" (
  "%~dp0\node.exe"  "%~dp0\..\purify-css\bin\purifycss" %*
) ELSE (
  node  "%~dp0\..\purify-css\bin\purifycss" %*
)