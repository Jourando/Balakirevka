unit Unit2;

interface

uses
  Winapi.Windows, Winapi.Messages, System.SysUtils, System.Variants, System.Classes, Vcl.Graphics,
  Vcl.Controls, Vcl.Forms, Vcl.Dialogs, Vcl.RibbonLunaStyleActnCtrls,
  Vcl.Ribbon, Vcl.StdCtrls, Vcl.ScreenTips, System.Actions, Vcl.ActnList,
  Vcl.ActnMan, Vcl.ExtActns, Vcl.ToolWin, Vcl.ActnCtrls, Vcl.ActnMenus,
  Vcl.RibbonActnMenus, Vcl.RibbonActnCtrls, Vcl.PlatformDefaultStyleActnCtrls;

type
  TForm1 = class(TForm)
    GroupBox1: TGroupBox;
    CheckBox1: TCheckBox;
    CheckBox2: TCheckBox;
    CheckBox3: TCheckBox;
    CheckBox4: TCheckBox;
    CheckBox5: TCheckBox;
    CheckBox6: TCheckBox;
    Ribbon1: TRibbon;
    ActionManager1: TActionManager;
    RibbonPage1: TRibbonPage;
    RibbonPage5: TRibbonPage;
    RibbonPage6: TRibbonPage;
    RibbonApplicationMenuBar1: TRibbonApplicationMenuBar;
    TabNextTab1: TNextTab;
    RibbonQuickAccessToolbar1: TRibbonQuickAccessToolbar;
    RibbonGroup1: TRibbonGroup;
    ActionManager2: TActionManager;
    RCB: TRibbonComboBox;
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;

implementation

{$R *.dfm}

end.
