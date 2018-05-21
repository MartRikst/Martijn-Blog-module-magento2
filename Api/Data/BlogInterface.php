<?php
namespace Martijn\Blog\Api\Data;

/**
 * Interface BlogInterface
 * @package Martijn\Blog\Api\Data
 */
interface BlogInterface
{
    const ID = 'id';
    const TITLE = 'title';
    const CONTENT = 'content';
    const POSTED_BY = 'posted_by';
    const DATE = 'date';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getContent();

    /**
     * @return string
     */
    public function getPostedBy();

    /**
     * @return string
     */
    public function getDate();

    /**
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * @param string $title
     * @return void
     */
    public function setTitle($title);

    /**
     * @param string $content
     * @return void
     */
    public function setContent($content);

    /**
     * @param string $name
     * @return void
     */
    public function setPostedBy($name);

    /**
     * @param string $date
     * @return void
     */
    public function setDate($date);

    /**
     * @return string
     */
    public function getUrl();

}