<?php
namespace MOC\MarkIV\Module\Document;

interface IApiInterface
{

    const FILE_TYPE_DEFAULT = null;

    public function openDocument( \MOC\MarkIV\Core\Drive\File\IApiInterface $File );

    public function closeDocument( \MOC\MarkIV\Core\Drive\File\IApiInterface $File, $Type = self::FILE_TYPE_DEFAULT );
}
