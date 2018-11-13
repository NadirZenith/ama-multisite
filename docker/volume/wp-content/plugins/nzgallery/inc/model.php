<?php

class NzGalleryModel
{

    const POST_TYPE = 'nz_media';
    const TAXONOMY = 'nz_media_collection';

    public function __construct()
    {
        $this->registerPostType();
        $this->registerTaxonomy();
        /*
          //video custom column
          add_filter('manage_yt_video_posts_columns', array($this, 'set_custom_columns'));
          add_action('manage_yt_video_posts_custom_column', array($this, 'custom_video_column'), 10, 2);

          //playlist custom column
          add_filter('manage_edit-yt_playlist_columns', array($this, 'set_custom_columns'), 10, 2);
          add_action('manage_yt_playlist_custom_column', array($this, 'custom_playlist_column'), 10, 3);

          //Add metabox video edit
          add_action('add_meta_boxes', array($this, 'add_metaboxes'));
         */
    }

    function add_metaboxes($columns)
    {
        add_meta_box('yttv_video_display', 'Youtube Video', array($this, 'video_metabox'), self::POST_TYPE, 'side', 'default');
    }

    function set_custom_columns($columns)
    {
        return array_merge(array('source' => __('Source', 'yttv')), $columns);
    }

    function custom_video_column($column, $post_id)
    {
        switch ($column) {
            case 'source' :
                $post = get_post($post_id);
                $img = get_post_meta($post_id, "default", true);
                echo sprintf('<a href="%s" target="_blank"><img src="%s"></a>', $post->guid, $img['url']);
        }
    }

    function custom_playlist_column($empty, $column, $term_id)
    {

        switch ($column) {
            case 'source' :
                if ($thumbnails = get_term_meta($term_id, 'yt_thumbnails', true)) {

                    $yt_id = get_term_meta($term_id, 'yt_id', true);
                    echo sprintf('<a href="https://www.youtube.com/playlist?list=%s" target="_black"><img src="%s"></a>', $yt_id, $thumbnails['default']['url']);
                }
        }
    }

    public function registerPostType()
    {
        $args_video = array(
            'labels' => array(
                'name' => __('Gallery'),
                'singular_name' => __('Gallery'),
                'add_new' => __('Añadir nueva foto'),
                'add_new_item' => __('Añadir foto'),
                'edit_item' => __('Editar foto'),
                'new_item' => __('Nueva foto'),
                'view_item' => __('Ver foto'),
                'search_items' => __('Buscar foto'),
                'not_found' => __("No se ha encontrado ningúna foto"),
                'not_found_in_trash' => __("No se ha encontrado nada en la papelera"),
                'parent_item_colon' => ''
            ),
            'public' => FALSE,
            'publicly_queryable' => false,
            'show_ui' => true,
            'hierarchical' => false,
            'show_in_admin_bar' => true,
            'query_var' => false,
            'can_export' => false,
            'exclude_from_search' => true,
            'taxonomies' => array(self::TAXONOMY),
            'supports' => array('title', 'thumbnail'),
            'menu_icon' => 'dashicons-format-video',
            'archive' => 'tv'
        );
        register_post_type(self::POST_TYPE, $args_video);
    }

    function video_metabox()
    {
        global $post;
        echo sprintf('<iframe style="width: 100%%;" class="yttv-preview" src="%s" frameborder="0"></iframe>', $post->guid);
        echo sprintf('<a class="small center" href="https://www.youtube.com/watch?v=%s" target="_blank">Ver no yt</a>', substr($post->guid, strrpos($post->guid, '/') + 1));
    }

    public function registerTaxonomy()
    {
        register_taxonomy(self::TAXONOMY, self::POST_TYPE, array(
            'label' => 'Galleries',
            'show_admin_column' => true,
            'hierarchical' => FALSE,
            /* 'rewrite' => array('slug' => 'playlist'), */
            'rewrite' => false,
            /* 'rewrite' => array('slug' => _x('tipo', 'tipo')), */
            'rewrite' => false,
            /* 'capabilities' => array() */
            )
        );
    }

    public static function init()
    {
        static $me;
        if (!$me)
            $me = new self ();
    }
}
