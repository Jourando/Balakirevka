unit PassWord2;

interface

uses Winapi.Windows, System.SysUtils, System.Classes, Vcl.Graphics, Vcl.Forms,
  Vcl.Controls, Vcl.StdCtrls, Vcl.Buttons, Vcl.ExtCtrls, Dialogs, Vcl.Themes,
  Vcl.CustomizeDlg;

type
  TCreatFastLog = class(TForm)
    Label1: TLabel;
    pass: TEdit;
    OKBtn: TButton;
    CancelBtn: TButton;
    login: TEdit;
    depart: TEdit;
    Label2: TLabel;
    Label3: TLabel;
    Panel1: TPanel;
    vi: TEdit;
    Label4: TLabel;
    serv_url: TEdit;
    Label5: TLabel;
    Memo1: TMemo;
    Bevel1: TBevel;
    CustomizeDlg1: TCustomizeDlg;
    cbRegistredStyles: TComboBox;
    Label6: TLabel;
    procedure OKBtnClick(Sender: TObject);
    procedure CancelBtnClick(Sender: TObject);
    procedure AddStyles(Sender: TObject);
    procedure ChStyle(Sender: TObject);

  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  CreatFastLog: TCreatFastLog;

implementation

{$R *.dfm}

procedure TCreatFastLog.AddStyles(Sender: TObject);
var  i: integer;
begin
  for i := 0 to Length(TStyleManager.StyleNames)-1 do cbRegistredStyles.Items.Add(TStyleManager.StyleNames[i]);
  cbRegistredStyles.ItemIndex:=0;
end;

procedure TCreatFastLog.CancelBtnClick(Sender: TObject);
begin
Application.Terminate;
end;

procedure TCreatFastLog.ChStyle(Sender: TObject);
begin
  TStyleManager.TrySetStyle(cbRegistredStyles.Items[cbRegistredStyles.ItemIndex], false);
end;

procedure TCreatFastLog.OKBtnClick(Sender: TObject);
var
rd: string;
rStr: string;
begin
    if (vi.Text='') then vi.Text:='10';
    rd:='rd=rd+vi+".php";';
    rStr:='location.href="'+serv_url.Text+'"+rd;';
    Memo1.Lines.Clear;
    Memo1.Lines[0]:='<HTML><HEAD>';
    Memo1.Lines.Add('<TITLE>INDEX PAGE</TITLE>');
    Memo1.Lines.Add('<SCRIPT src="ver.js"></SCRIPT>');
    Memo1.Lines.Add('<SCRIPT src="globals2.js"></SCRIPT>');
    Memo1.Lines.Add('</HEAD><BODY>');
    Memo1.Lines.Add('<!-- Generated by FastLog Creator -->');
    Memo1.Lines.Add('<h3>Index</h3>');
    Memo1.Lines.Add('<SCRIPT>');
    Memo1.Lines.Add(rd);
    Memo1.Lines.Add(rStr);
    Memo1.Lines.Add('</SCRIPT>');
    Memo1.Lines.Add('</BODY></HTML>');
    Memo1.Lines.SaveToFile('index.htm');
    ShowMessage('������� ���������!');
end;



end.

