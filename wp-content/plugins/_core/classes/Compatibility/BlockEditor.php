<?php

namespace Core\Compatibility;

class BlockEditor
{
    const POST_TYPES = [
        'post',
        'page',
    ];

    const BLOCKS = [
        'core/group', // 06/19/2019 - Pulling from the Gutenberg plugin until it's in core.
        'core/paragraph',
        'core/image',
        'core/heading',
        'core/gallery',
        'core/list',
        'core/quote',
        // 'core/shortcode',
        // 'core/archives',
        // 'core/audio',
        'core/button',
        // 'core/categories',
        'core/code',
        'core/columns',
        'core/column',
        // 'core/cover',
        // 'core/embed',
        // 'core-embed/twitter',
        // 'core-embed/youtube',
        // 'core-embed/facebook',
        // 'core-embed/instagram',
        // 'core-embed/wordpress',
        // 'core-embed/soundcloud',
        // 'core-embed/spotify',
        // 'core-embed/flickr',
        // 'core-embed/vimeo',
        // 'core-embed/animoto',
        // 'core-embed/cloudup',
        // 'core-embed/collegehumor',
        // 'core-embed/dailymotion',
        // 'core-embed/funnyordie',
        // 'core-embed/hulu',
        // 'core-embed/imgur',
        // 'core-embed/issuu',
        // 'core-embed/kickstarter',
        // 'core-embed/meetup-com',
        // 'core-embed/mixcloud',
        // 'core-embed/photobucket',
        // 'core-embed/polldaddy',
        // 'core-embed/reddit',
        // 'core-embed/reverbnation',
        // 'core-embed/screencast',
        // 'core-embed/scribd',
        // 'core-embed/slideshare',
        // 'core-embed/smugmug',
        // 'core-embed/speaker',
        // 'core-embed/speaker-deck',
        // 'core-embed/ted',
        // 'core-embed/tumblr',
        // 'core-embed/videopress',
        // 'core-embed/wordpress-tv',
        // 'core/file',
        // 'core/freeform',
        // 'core/html',
        'core/media-text',
        // 'core/latest-comments',
        // 'core/latest-posts',
        // 'core/missing',
        // 'core/more',
        // 'core/nextpage',
        // 'core/preformatted',
        // 'core/pullquote',
        // 'core/separator',
        'core/block',
        'core/spacer',
        // 'core/subhead',
        // 'core/table',
        // 'core/template',
        // 'core/text-columns',
        // 'core/verse',
        // 'core/video',
    ];

    public static function init()
    {
        $class = new self;
        add_filter('use_block_editor_for_post_type', [$class, 'enable_block_editor_for_post_types'], 10, 2);
        add_filter('allowed_block_types', [$class, 'allowed_blocks'], 10, 2);
    }

    public function enable_block_editor_for_post_types($use_block_editor, $post_type)
    {
        return in_array($post_type, self::POST_TYPES);
    }

    public function allowed_blocks($allowed_blocks, $post)
    {
        return apply_filters('core/blocks', self::BLOCKS);
    }
}