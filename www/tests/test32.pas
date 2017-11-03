interface

uses
 Windows, Messages, SysUtils, Classes, Graphics, Controls, Forms, Winsock,
 Dialogs, StdCtrls, ExtCtrls;

const
 MAX_ADAPTER_ADDRESS_LENGTH = 6;

type
 TMacAddress = array[0..MAX_ADAPTER_ADDRESS_LENGTH - 1] of byte;

 TForm1 = class(TForm)
    Host: TLabel;
    IPaddr: TLabel;
    Mac: TLabel;
    UserNm: TLabel;
    procedure FormCreate(Sender: TObject);
 end;

 function SendARP(const DestIP, SrcIP: ULONG;
   pMacAddr: PULONG; var PhyAddrLen: ULONG): DWORD; stdcall; external 'IPHLPAPI.DLL';

var
 Form1: TForm1;

implementation

{$R *.dfm}
function GetMAC(Value: TMacAddress; Length: DWORD): String;
var
  I: Integer;
begin
   if Length = 0 then Result := '00-00-00-00-00-00'
   else begin
     Result := '';
     for i:= 0 to Length - 2 do
       Result := Result + IntToHex(Value[i], 2) + '-';
     Result := Result + IntToHex(Value[Length-1], 2);
   end;
end;

procedure TForm1.FormCreate(Sender: TObject);
const
   cnMaxUserNameLen = 254;
var
  wVerReq: WORD;
  wsaData: TWSAData;
  i: PAnsiChar;
  h: PHostEnt;
  c: array[0..128] of char;
  DestIP, SrcIP: ULONG;
  pMacAddr: TMacAddress;
  PhyAddrLen: ULONG;
  sUserName: string;
  dwUserNameLen: DWORD;
begin
  wVerReq := MAKEWORD(1, 1);
  WSAStartup(wVerReq, wsaData);
  {Получаем хост (имя) компа}
  GetHostName(@c, 128);
  h := GetHostByName(@c);
  Host.Caption := h^.h_Name; //Host отображает хост(имя) компьютера
  {Достаем IP}
  i := iNet_ntoa(PInAddr(h^.h_addr_list^)^);
  IPaddr.Caption := i; //Теперь IPaddr отображает IP-адрес
  WSACleanup;
  DestIP := inet_addr(i);
  PhyAddrLen := 6;
  SendArp(DestIP, 0, @pMacAddr, PhyAddrLen);
  Mac.Caption := GetMAC(pMacAddr, PhyAddrLen);
  dwUserNameLen := cnMaxUserNameLen - 1;
  SetLength(sUserName, cnMaxUserNameLen);
  GetUserName(PChar(sUserName), dwUserNameLen);
  SetLength(sUserName, dwUserNameLen);
  UserNm.Caption:=sUserName;
end;

end.