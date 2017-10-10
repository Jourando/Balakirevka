object CreatFastLog: TCreatFastLog
  Left = 245
  Top = 108
  BorderIcons = [biSystemMenu]
  BorderStyle = bsDialog
  Caption = #1057#1086#1079#1076#1072#1090#1100' index.html'
  ClientHeight = 383
  ClientWidth = 279
  Color = clBtnFace
  ParentFont = True
  FormStyle = fsStayOnTop
  OldCreateOrder = True
  Position = poDefault
  OnCreate = AddStyles
  PixelsPerInch = 96
  TextHeight = 13
  object Label1: TLabel
    Left = 8
    Top = 237
    Width = 82
    Height = 13
    Caption = #1042#1074#1077#1076#1080#1090#1077' '#1087#1072#1088#1086#1083#1100
    Enabled = False
  end
  object Label2: TLabel
    Left = 8
    Top = 144
    Width = 82
    Height = 13
    Caption = #1042#1074#1077#1076#1080#1090#1077' '#1088#1072#1079#1076#1077#1083
    Enabled = False
  end
  object Label3: TLabel
    Left = 8
    Top = 192
    Width = 75
    Height = 13
    Caption = #1042#1074#1077#1076#1080#1090#1077' '#1083#1086#1075#1080#1085
    Enabled = False
  end
  object Label4: TLabel
    Left = 174
    Top = 144
    Width = 93
    Height = 13
    Caption = #1042#1077#1088#1089#1080#1103' '#1087#1088#1086#1075#1088#1072#1084#1084#1099
  end
  object Label5: TLabel
    Left = 8
    Top = 98
    Width = 75
    Height = 13
    Caption = #1040#1076#1088#1077#1089' '#1089#1077#1088#1074#1077#1088#1072
  end
  object Bevel1: TBevel
    Left = 0
    Top = 328
    Width = 279
    Height = 9
  end
  object pass: TEdit
    Left = 8
    Top = 256
    Width = 263
    Height = 21
    Color = clInfoBk
    Enabled = False
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clHotLight
    Font.Height = -11
    Font.Name = 'Tahoma'
    Font.Style = []
    ParentFont = False
    PasswordChar = '*'
    TabOrder = 6
  end
  object OKBtn: TButton
    Left = 94
    Top = 283
    Width = 75
    Height = 25
    Caption = 'OK'
    Default = True
    ModalResult = 1
    TabOrder = 7
    OnClick = OKBtnClick
  end
  object CancelBtn: TButton
    Left = 174
    Top = 283
    Width = 75
    Height = 25
    Cancel = True
    Caption = 'Cancel'
    ModalResult = 2
    TabOrder = 8
    OnClick = CancelBtnClick
  end
  object login: TEdit
    Left = 8
    Top = 211
    Width = 263
    Height = 21
    Color = clInfoBk
    Enabled = False
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clHotLight
    Font.Height = -11
    Font.Name = 'Tahoma'
    Font.Style = []
    ParentFont = False
    TabOrder = 5
  end
  object depart: TEdit
    Left = 8
    Top = 168
    Width = 121
    Height = 21
    Color = clInfoBk
    Enabled = False
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clHotLight
    Font.Height = -11
    Font.Name = 'Tahoma'
    Font.Style = []
    ParentFont = False
    TabOrder = 3
  end
  object Panel1: TPanel
    Left = 0
    Top = 1
    Width = 279
    Height = 91
    TabOrder = 0
    object Label6: TLabel
      Left = 48
      Top = 32
      Width = 146
      Height = 13
      Caption = #1057#1086#1079#1076#1072#1085#1080#1077' '#1080#1085#1076#1077#1082#1089#1085#1086#1075#1086' '#1092#1072#1081#1083#1072
    end
  end
  object vi: TEdit
    Left = 174
    Top = 168
    Width = 97
    Height = 21
    Color = clInfoBk
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clHotLight
    Font.Height = -11
    Font.Name = 'Tahoma'
    Font.Style = []
    ParentFont = False
    TabOrder = 4
    Text = '10'
  end
  object serv_url: TEdit
    Left = 8
    Top = 117
    Width = 263
    Height = 21
    Color = clInfoBk
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clHotLight
    Font.Height = -11
    Font.Name = 'Tahoma'
    Font.Style = []
    ParentFont = False
    TabOrder = 2
    Text = 'http://test2.ru/'
  end
  object Memo1: TMemo
    Left = 12
    Top = 384
    Width = 259
    Height = 229
    TabOrder = 1
    Visible = False
  end
  object cbRegistredStyles: TComboBox
    Left = 94
    Top = 354
    Width = 177
    Height = 21
    Color = clInfoBk
    DoubleBuffered = True
    ParentDoubleBuffered = False
    Sorted = True
    TabOrder = 9
    Text = 'cbRegistredStyles'
    OnChange = ChStyle
  end
  object CustomizeDlg1: TCustomizeDlg
    StayOnTop = False
    Left = 224
    Top = 40
  end
end
