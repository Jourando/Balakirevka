unit main;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, IniFiles;

type
  TForm1 = class(TForm)
    Button1: TButton;
    Button2: TButton;
    Button3: TButton;
    Button4: TButton;
    Edit1: TEdit;
    ListBox1: TListBox;
    Edit2: TEdit;
    Button5: TButton;
    procedure Button1Click(Sender: TObject);
    procedure Button2Click(Sender: TObject);
    procedure Button3Click(Sender: TObject);
    procedure Button5Click(Sender: TObject);
    procedure Button4Click(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;

implementation

{$R *.dfm}

procedure TForm1.Button1Click(Sender: TObject);
begin
Application.Terminate;
end;

procedure TForm1.Button2Click(Sender: TObject);
var
   MyFile:TIniFile;
   dir:string;
begin
   GetDir(0,dir);
   MyFile:=TIniFile.Create(dir+'\Пример к статье'+'.ini');
   MyFile.WriteString('1','Ident','HELLO');
   MyFile.Free;
end;

procedure TForm1.Button3Click(Sender: TObject);
var
   MyFile:TIniFile;
   dir:string;
begin
   GetDir(0,dir);
   MyFile:=TIniFile.Create(dir+'\Пример к статье'+'.ini');
   MyFile.WriteString('Данные','Поле №1', Edit1.Text);
   MyFile.Free;
end;

procedure TForm1.Button5Click(Sender: TObject);
var
   MyFile:TIniFile;
   dir:string;
begin
   GetDir(0,dir);
   MyFile:=TIniFile.Create(dir+'\Пример к статье'+'.ini');
   MyFile.EraseSection(Edit2.Text);
   MyFile.Free;
end;

procedure TForm1.Button4Click(Sender: TObject);
var
   MyFile:TIniFile;
   dir:string;
begin
   GetDir(0,dir);
   MyFile:=TIniFile.Create(dir+'\Пример к статье'+'.ini');
   MyFile.ReadSections(ListBox1.Items);
   MyFile.Free;

end;

end.
