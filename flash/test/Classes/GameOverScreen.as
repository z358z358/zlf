package 
{
	import flash.display.MovieClip;
	import flash.display.SimpleButton;
	import flash.events.MouseEvent;
	import flash.text.TextField;
	import flash.ui.Mouse;
	import flash.net.SharedObject;
	import flash.net.*;
	
	public class GameOverScreen extends MovieClip 
	{
		public var restartButton:SimpleButton;
		public var finalScore:TextField;
		public var finalClockTime:TextField;
		public var bestScore:TextField;
		public var sharedObject:SharedObject;
		public var account:TextField;
		public var upload:SimpleButton;

		
		public function GameOverScreen() 
		{
			Mouse.show();
			restartButton.addEventListener( MouseEvent.CLICK, onClickRestart, false, 0, true );
			upload.addEventListener( MouseEvent.CLICK, onClickUpload, false, 0, true );
			sharedObject = SharedObject.getLocal( "mjwScores" );
			
		}
		
		public function onClickRestart( mouseEvent:MouseEvent ):void 
		{
			dispatchEvent( new NavigationEvent( NavigationEvent.RESTART ) );
		}
		
		public function onClickUpload( mouseEvent:MouseEvent ):void 
		{
			trace("Sending Data to AMFPHP");
var test:NetConnection = new NetConnection();
// 新增一個NetConnection物件

test.connect('http://127.0.0.1/amfphp/gateway.php');
// 連上AMF gateway
// 這裡每家AMF gateway的實作方法應該都有差別，細節請記得看該實作說明

var returnResult:Responder = new Responder(ok, ng);
// 準備一個Responder物件來接收事件，用法及參數請參考F1說明

function ok(res:Object):void {
  trace(res);
  upload.visible=false;
}

function ng(res:Object):void {
  trace("no");
}
//以上，我做了ok跟ng兩個簡單小function，分別是trace出它們接收到的物件

var all=account.text+"+"+finalScore.text;

test.call('callme.callmeplease', returnResult, all);
			
		}
		
		public function setFinalScore( scoreValue:Number ):void
		{
			finalScore.text = scoreValue.toString();
			try
			{
				if ( sharedObject.data.bestScore == null )
				{
					sharedObject.data.bestScore = scoreValue;
				}
				else if ( scoreValue > sharedObject.data.bestScore )
				{
					sharedObject.data.bestScore = scoreValue;
				}
				bestScore.text = sharedObject.data.bestScore.toString();
				sharedObject.flush();
			}
			catch ( sharedObjectError:Error )
			{
				trace( "Caught this error:", sharedObjectError.name, sharedObjectError.message );
				bestScore.text = "???";
			}
		}
		
		public function setFinalClockTime( clockValue:Number ):void
		{
			finalClockTime.text = Math.floor( clockValue / 1000 ).toString();
		}
	}
}