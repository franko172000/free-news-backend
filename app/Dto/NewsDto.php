<?php

namespace App\Dto;

use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class NewsDto extends DataTransferObject
{
    public string $title;
    public string $content;
    public string $url;
    public string $author;
    public string $imagePath;
    public string $category;
}
