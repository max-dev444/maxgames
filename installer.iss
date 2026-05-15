[Setup]
AppName=Chromaticium
AppVersion=1.0
DefaultDirName={autopf}\Chromaticium
DefaultGroupName=Chromaticium
OutputBaseFilename=ChromaticiumSetup
Compression=lzma
SolidCompression=yes

[Files]
Source: "dist\Chromaticium.exe"; DestDir: "{app}"; Flags: ignoreversion

[Icons]
Name: "{group}\Chromaticium"; Filename: "{app}\Chromaticium.exe"
Name: "{commondesktop}\Chromaticium"; Filename: "{app}\Chromaticium.exe"

[Run]
Filename: "{app}\Chromaticium.exe"; Description: "Launch Chromaticium"; Flags: nowait postinstall skipifsilent