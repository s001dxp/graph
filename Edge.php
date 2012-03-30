<?php

abstract class Edge{
	
// 	abstract public function hasVertexTo($vertex);
	
// 	abstract public function hasVertexFrom($vertex);
	
	abstract public function isConnection($from, $to);
	
// 	abstract public function getVerticesTo();
	
	/**
	 * get target vertex we can reach with this edge from the given start vertex
	 *
	 * @param Vertex $startVertex
	 * @return Vertex
	 * @throws Exception if given $startVertex is not a valid start
	 * @see Edge::hasEdgeFrom() to check if given start is valid
	 */
	abstract public function getVertexToFrom($startVertex);
	
	/**
	 * get start vertex which can reach us(the given end vertex) with this edge
	 *
	 * @param Vertex $startVertex
	 * @return Vertex
	 * @throws Exception if given $startVertex is not a valid start
	 * @see Edge::hasEdgeFrom() to check if given start is valid
	 */
	abstract public function getVertexFromTo($endVertex);
	
// 	abstract public function getVerticesFrom();
}
