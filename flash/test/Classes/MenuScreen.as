package 
{
	import flash.display.MovieClip;
	import flash.display.SimpleButton;
	import flash.events.MouseEvent;
	import flash.ui.Mouse;
	
	public class MenuScreen extends MovieClip 
	{
		public var startButton:SimpleButton;
		
		public function MenuScreen() 
		{
			Mouse.show();
			startButton.addEventListener( MouseEvent.CLICK, onClickStart, false, 0, true );
		}
		
		public function onClickStart( event:MouseEvent ):void
		{
			dispatchEvent( new NavigationEvent( NavigationEvent.START ) );
		}
	}
}