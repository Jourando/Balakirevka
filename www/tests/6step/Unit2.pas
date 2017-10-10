unit Unit2;

interface

uses
  System.SysUtils, System.Types, System.Variants, System.UITypes,
  System.Classes, FMX.Types, FMX.Graphics, FMX.Dialogs, FMX.Types3D, FMX.Forms,
  FMX.Forms3D, FMX.Controls3D, System.Math.Vectors, FMX.Edit, FMX.Media,
  FMX.Effects, FMX.Ani, FMX.Layers3D, FMX.Viewport3D, FMX.TabControl,
  FMX.Controls, FMX.Header;

type
  TForm1 = class(TForm3D)
    Header1: THeader;
    TabControl1: TTabControl;
    Viewport3D1: TViewport3D;
    SolidLayer3D1: TSolidLayer3D;
    Layer3D1: TLayer3D;
    Layout3D1: TLayout3D;
    TextLayer3D1: TTextLayer3D;
    TextLayer3D2: TTextLayer3D;
    FloatAnimation1: TFloatAnimation;
    ShadowEffect1: TShadowEffect;
    CameraComponent1: TCameraComponent;
    NumberBox1: TNumberBox;
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;

implementation

{$R *.fmx}

end.
