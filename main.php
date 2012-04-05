<?php

spl_autoload_register(function($class){
    require_once(__DIR__.'/'.str_replace('_','/',$class).'.php');
});

$interface = new main();

class main{
	
	/**
	 * 
	 * @var Graph
	 */
	private $graph = NULL;
	
	private function getFiles() {
		$files = array();
		$dir = openDir("data");
		$i = 0;
		while ($file = readDir($dir)) {
			if ($file != "." && $file != "..") {
				$files[$i] = $file;
				++$i;
			}
		}
		closeDir($dir);
		
		return $files;
	}
	
	public function __construct(){
		echo "Read Graph-File:\n\n";
		
		$this->readFile();
		
		echo "\n";
		
		while(true){
			$this->chooseAction();
			
			echo "\n";
		}
	}
	
	private function readFile(){
		$fileFormatRightInput = false;
		$fileNameRightInput = false;
		
		$fileFormat = NULL;
		$fileName = NULL;
		
		while($fileFormatRightInput == false)
		{
			echo "What kind of File you want to read?\n";
			echo "0 = Adjacency matrix\n";
			echo "1 = Edge list\n";
			echo "2 = Create complete graph\n";
		
			fscanf(STDIN, "%d\n", $fileFormat);
		
			switch ($fileFormat){
				case 0:
				case 1:
				case 2:
					$fileFormatRightInput = true;
			}
		}
		
		while($fileNameRightInput == false)
		{
			echo "Please enter the file name?\n";
		
			fscanf(STDIN, "%s\n", $fileName);
			
			$fileNameRightInput = true;
		}
		
		switch ($fileFormat){
			case 0:
				$loaderAdjacencyMatrix = new LoaderAdjacencyMatrix();
				$loaderAdjacencyMatrix->setFileName($fileName);
				$this->graph = $loaderAdjacencyMatrix->getGraph();
				$rightInput = true;
				break;
			case 1:
				$interface = new LoaderEdgeList();
				$interface->setFileName($fileName);
				$this->graph = $interface->getGraph();
				$rightInput = true;
				break;
			case 2:
				$interface = new LoaderCompleteGraph();
				$interface->setNumverOfVertices($fileName);
				$this->graph = $interface->getGraph();
				$rightInput = true;
				break;
		}
	}

	private function chooseAction(){
		$chooseOption = false;
		
		while($chooseOption == false)
		{
			echo "What do you want to do?\n";
			echo "0 = breadth-first search\n";
			echo "1 = depth-first search\n";
			echo "2 = components of graph\n";
		
			fscanf(STDIN, "%d\n", $option);
		
			switch ($option){
				case 0:
					$this->startSearchBreadthFirst();
					$chooseOption = true;
					break;
				case 1:
					$this->startSearchDepthFirst();
					$chooseOption = true;
					break;
				case 2:
					echo "The graph has ";
					echo $this->graph->getNumberOfComponents();
					echo " components\n";
					$chooseOption = true;
					break;
			}
		}
	}
	
	private function startSearchBreadthFirst(){
		echo "Please enter the name of the starting node?\n";
		
		fscanf(STDIN, "%s\n", $startingNode);
		
		$this->printArrayOfVertices($this->graph->getVertex($startingNode)->searchBreadthFirst());
	}
	
	private function startSearchDepthFirst(){
		echo "Please enter the name of the starting node?\n";
	
		fscanf(STDIN, "%s\n", $startingNode);

		$this->printArrayOfVertices($this->graph->getVertex($startingNode)->searchDepthFirst());
	}
	
	/**
	 * 
	 * @param array[Vertex] $array
	 */
	private function printArrayOfVertices($array){
		
		echo "\n\n";
		
		foreach ($array as $vertex){
			echo $vertex->getId(); echo "\n";
		}
	}
}
