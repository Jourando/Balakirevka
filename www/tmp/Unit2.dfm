object Form1: TForm1
  Left = 0
  Top = 0
  Caption = 'Form1'
  ClientHeight = 445
  ClientWidth = 635
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'Tahoma'
  Font.Style = []
  OldCreateOrder = False
  PixelsPerInch = 96
  TextHeight = 13
  object GroupBox1: TGroupBox
    Left = 8
    Top = 232
    Width = 297
    Height = 193
    Caption = 'Install/repair Menu'
    TabOrder = 0
    object CheckBox1: TCheckBox
      Left = 16
      Top = 32
      Width = 97
      Height = 17
      Caption = 'Create verinfo'
      TabOrder = 0
    end
    object CheckBox2: TCheckBox
      Left = 16
      Top = 55
      Width = 153
      Height = 17
      Caption = 'Create/edit main menu.opt'
      TabOrder = 1
    end
    object CheckBox3: TCheckBox
      Left = 16
      Top = 78
      Width = 97
      Height = 17
      Caption = 'Create init.opt'
      TabOrder = 2
    end
    object CheckBox4: TCheckBox
      Left = 16
      Top = 101
      Width = 97
      Height = 17
      Caption = 'Create index'
      TabOrder = 3
    end
    object CheckBox5: TCheckBox
      Left = 16
      Top = 124
      Width = 193
      Height = 17
      Caption = 'Create departs0 based on menu.opt'
      TabOrder = 4
    end
    object CheckBox6: TCheckBox
      Left = 16
      Top = 147
      Width = 169
      Height = 17
      Caption = 'Create other departs (empty)'
      TabOrder = 5
    end
  end
  object Ribbon1: TRibbon
    Left = 0
    Top = 0
    Width = 635
    Height = 143
    ActionManager = ActionManager1
    ApplicationMenu.Menu = RibbonApplicationMenuBar1
    Caption = 'Ribbon1'
    DocumentName = 'New Ribbon'
    QuickAccessToolbar.ActionBar = RibbonQuickAccessToolbar1
    Tabs = <
      item
        Caption = 'RibbonPage1'
        Page = RibbonPage1
      end
      item
        Caption = 'RibbonPage5'
        Page = RibbonPage5
      end
      item
        Caption = 'RibbonPage6'
        Page = RibbonPage6
      end>
    TabIndex = 2
    DesignSize = (
      635
      143)
    StyleName = 'Ribbon - Luna'
    object RibbonPage5: TRibbonPage
      Left = 0
      Top = 50
      Width = 634
      Height = 93
      Caption = 'RibbonPage5'
      Index = 1
    end
    object RibbonApplicationMenuBar1: TRibbonApplicationMenuBar
      ActionManager = ActionManager1
      OptionItems = <>
      RecentItems = <>
    end
    object RibbonQuickAccessToolbar1: TRibbonQuickAccessToolbar
      Left = 49
      Top = 1
      Width = 48
      Height = 24
      ActionManager = ActionManager1
    end
    object RibbonPage1: TRibbonPage
      Left = 0
      Top = 50
      Width = 634
      Height = 93
      Caption = 'RibbonPage1'
      Index = 0
    end
    object RibbonPage6: TRibbonPage
      Left = 0
      Top = 50
      Width = 634
      Height = 93
      Caption = 'RibbonPage6'
      Index = 2
      object RibbonGroup1: TRibbonGroup
        Left = 4
        Top = 3
        Width = 158
        Height = 86
        ActionManager = ActionManager2
        Caption = 'RibbonGroup1'
        DialogAction = TabNextTab1
        GroupIndex = 0
        object RCB: TRibbonComboBox
          AlignWithMargins = True
          Left = 102
          Top = 6
          Width = 38
          Height = 15
          Items.Strings = (
            '1line'
            '2line'
            '3line')
          MaxLength = 10
          NumbersOnly = True
          TabOrder = 0
          Text = 'ShowMe'
        end
      end
    end
  end
  object ActionManager1: TActionManager
    ActionBars = <
      item
      end
      item
      end
      item
      end
      item
        Items = <
          item
            ChangesAllowed = [caModify]
            ContextItems = <
              item
                Caption = 'ActionClientItem0'
              end
              item
                Caption = 'ActionClientItem1'
              end
              item
                Caption = 'ActionClientItem2'
              end>
            Items = <
              item
                Action = TabNextTab1
              end>
            Caption = 'ActionClientItem0'
            KeyTip = 'F'
          end>
        ActionBar = RibbonApplicationMenuBar1
        AutoSize = False
      end
      item
        ActionBar = RibbonQuickAccessToolbar1
        AutoSize = False
      end>
    LinkedActionLists = <
      item
        Caption = '(No Name)'
      end
      item
        Caption = '(No Name)'
      end
      item
        Caption = '(No Name)'
      end
      item
        Caption = '(No Name)'
      end>
    Left = 536
    Top = 80
    StyleName = 'Ribbon - Luna'
    object TabNextTab1: TNextTab
      Caption = '&Next'
      Enabled = False
      Hint = 'Next|Go to the next tab'
    end
  end
  object ActionManager2: TActionManager
    ActionBars = <
      item
        Items = <
          item
            Caption = 'RibbonComboBox1'
            CommandStyle = csComboBox
            CommandProperties.Width = 150
            CommandProperties.ContainedControl = RCB
          end>
        ActionBar = RibbonGroup1
      end
      item
      end
      item
      end>
    Left = 472
    Top = 72
    StyleName = 'Platform Default'
  end
end
