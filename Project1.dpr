program Project1;

uses
  Vcl.Forms,
  PassWord in 'PassWord.pas' {CreatFastLog},
  Vcl.Themes,
  Vcl.Styles;

{$R *.res}

begin
  Application.Initialize;
  Application.MainFormOnTaskbar := True;
  Application.Title := 'CreatFastLog';
  TStyleManager.TrySetStyle('Luna');
  Application.CreateForm(TCreatFastLog, CreatFastLog);
  Application.Run;
end.
