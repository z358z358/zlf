package
{
	public class LevelData
	{
		public var backgroundImage:String;
		public var pointsToReachNextLevel:Number;
		public var enemySpawnRate:Number;
		public var levelNum:Number;
		
		public function LevelData( levelNumber:Number )
		{
			levelNum = levelNumber;
			if ( levelNumber == 1 )
			{
				backgroundImage = "blue";
				pointsToReachNextLevel = 150;
				enemySpawnRate = 0.05;
			}
			else if ( levelNumber == 2 )
			{
				backgroundImage = "red";
				pointsToReachNextLevel = 350;
				enemySpawnRate = 0.1;
			}
			else if ( levelNumber == 3 )
			{
				backgroundImage = "blue";
				pointsToReachNextLevel = 600;
				enemySpawnRate = 0.13;
			}
			else if ( levelNumber == 4 )
			{
				backgroundImage = "red";
				pointsToReachNextLevel = 770;
				enemySpawnRate = 0.15;
			}
			else
			{
				if ( levelNumber % 2 == 1 )
				{
					backgroundImage = "blue";
				}
				else
				{
					backgroundImage = "red";
				}
				pointsToReachNextLevel = levelNumber * 200;
				enemySpawnRate = 0.5 - ( 2 / levelNumber );
			}
		}
	}
}