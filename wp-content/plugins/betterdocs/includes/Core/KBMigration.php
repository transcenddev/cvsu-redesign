<?php

namespace WPDeveloper\BetterDocs\Core;

use WPDeveloper\BetterDocs\Utils\Base;
use WPDeveloper\BetterDocs\Utils\Helper;

class KBMigration extends Base {
    public function migrate() {
        $existing_plugins = $this->knowledge_base_plugins();
        $existing_plugins_data = $this->existing_plugins_data( $existing_plugins[0][0] );
        if ( isset( $existing_plugins_data['name'] ) && isset( $existing_plugins_data['url'] ) ) {
            if ( $existing_plugins_data['name'] === 'echo-knowledge-base' ) {
                $this->eco_knowledgebase_migration();
            } elseif ( $existing_plugins_data['name'] === 'pressapps-knowledge-base' ) {
                $this->pressapps_migration();
            }
            deactivate_plugins( $existing_plugins_data['url'] );
        }
    }

    public function knowledge_base_plugins() {
        $plugins = [];

        if ( Helper::is_plugin_active( 'wedocs/wedocs.php' ) ) {
            $plugins[] = ['wedocs', 'weDocs'];
        }
        if ( Helper::is_plugin_active( 'bsf-docs/bsf-docs.php' ) ) {
            $plugins[] = ['bsf-docs', 'BSF docs'];
        }
        if ( Helper::is_plugin_active( 'documentor-lite/documentor-lite.php' ) ) {
            $plugins[] = ['documentor-lite', 'Documentor'];
        }
        if ( Helper::is_plugin_active( 'echo-knowledge-base/echo-knowledge-base.php' ) ) {
            $plugins[] = ['echo-knowledge-base', 'Echo Knowledge Base'];
        }
        if ( Helper::is_plugin_active( 'pressapps-knowledge-base/pressapps-knowledge-base.php' ) ) {
            $plugins[] = ['pressapps-knowledge-base', 'PressApps Knowledge Base'];
        }

        return $plugins;
    }

    public function insert_terms_hierarchically( $existing_term, $new_term, $parentId = 0 ) {
        $into = [];
        $cats = get_terms( $existing_term, ['hide_empty' => false] );
        if ( $cats ) {
            foreach ( $cats as $i => $cat ) {
                if ( $cat->parent == $parentId ) {
                    $into[$cat->term_id] = $cat;
                    unset( $cats[$i] );
                    $doc_parent_term = term_exists( $cat->name, $new_term );
                    wp_insert_term(
                        $cat->name,
                        $new_term,
                        [
                            'alias_of'    => $cat->slug,
                            'description' => $cat->description,
                            'slug'        => $cat->slug,
                            'parent'      => $cat->parent
                        ]
                    );
                }
            }
            if ( $cats ) {
                foreach ( $cats as $i => $cat ) {
                    $get_existing_term = get_term_by( 'id', $cat->parent, $existing_term );
                    $doc_parent_term   = term_exists( $get_existing_term->name, $new_term );
                    wp_insert_term(
                        $cat->name,
                        $new_term,
                        [
                            'alias_of'    => $cat->slug,
                            'description' => $cat->description,
                            'slug'        => $cat->slug,
                            'parent'      => $doc_parent_term['term_id']
                        ]
                    );
                }
            }
        }
    }

    public function insert_posts( $existing_post, $existing_cat, $existing_tag ) {
        $args = [
            'post_type'      => $existing_post,
            'post_status'    => 'any',
            'posts_per_page' => -1
        ];
        $postslist = get_posts( $args );
        if ( $postslist ) {
            foreach ( $postslist as $post ) {
                // Create post object
                if ( ! get_page_by_title( $post->post_title, 'OBJECT', 'docs' ) ) {
                    $post_args = [
                        'post_type'             => 'docs',
                        'post_title'            => $post->post_title,
                        'post_content'          => $post->post_content,
                        'post_status'           => $post->post_status,
                        'post_author'           => $post->post_author,
                        'post_date'             => $post->post_date,
                        'post_date_gmt'         => $post->post_date_gmt,
                        'post_excerpt'          => $post->post_excerpt,
                        'comment_status'        => $post->comment_status,
                        'ping_status'           => $post->ping_status,
                        'post_password'         => $post->post_password,
                        'post_name'             => $post->post_name,
                        'to_ping'               => $post->to_ping,
                        'pinged'                => $post->pinged,
                        'post_modified'         => $post->post_modified,
                        'post_modified_gmt'     => $post->post_modified_gmt,
                        'post_content_filtered' => $post->post_content_filtered,
                        'post_parent'           => $post->post_parent,
                        'post_mime_type'        => $post->post_mime_type,
                        'comment_count'         => $post->comment_count,
                        'filter'                => $post->filter
                    ];
                    // Insert the post into the database
                    $result = wp_insert_post( $post_args );
                    if ( $result && ! is_wp_error( $result ) ) {
                        $cat_list = wp_get_post_terms( $post->ID, $existing_cat, ['fields' => 'all'] );
                        if ( $cat_list ) {
                            $post_id = $result;
                            wp_set_object_terms( $post_id, [$cat_list['0']->name], 'doc_category', false );
                        }
                        $tag_list = wp_get_post_terms( $post->ID, $existing_tag, ['fields' => 'all'] );
                        if ( $tag_list ) {
                            $post_id = $result;
                            wp_set_object_terms( $post_id, [$tag_list['0']->name], 'doc_tag', false );
                        }
                    }
                }
            }
        }
    }

    public function existing_plugins_data( $plugins ) {
        $plugins_data = [];
        if ( $plugins === 'wedocs' ) {
            $plugins_data['name'] = 'wedocs';
            $plugins_data['url']  = 'wedocs/wedocs.php';
        }
        if ( $plugins === 'bsf-docs' ) {
            $plugins_data['name'] = 'bsf-docs';
            $plugins_data['url']  = 'bsf-docs/bsf-docs.php';
        }
        if ( $plugins === 'documentor-lite' ) {
            $plugins_data['name'] = 'documentor-lite';
            $plugins_data['url']  = 'documentor-lite/documentor-lite.php';
        }
        if ( $plugins === 'echo-knowledge-base' ) {
            $plugins_data['name'] = 'echo-knowledge-base';
            $plugins_data['url']  = 'echo-knowledge-base/echo-knowledge-base.php';
        }
        if ( $plugins === 'pressapps-knowledge-base' ) {
            $plugins_data['name'] = 'pressapps-knowledge-base';
            $plugins_data['url']  = 'pressapps-knowledge-base/pressapps-knowledge-base.php';
        }
        return $plugins_data;
    }

    public function eco_knowledgebase_migration() {
        $this->insert_terms_hierarchically( 'epkb_post_type_1_category', 'doc_category' );
        $this->insert_terms_hierarchically( 'epkb_post_type_1_tag', 'doc_tag' );
        $this->insert_posts( 'epkb_post_type_1', 'epkb_post_type_1_category', 'epkb_post_type_1_tag' );
    }

    public function pressapps_migration() {
        $this->insert_terms_hierarchically( 'knowledgebase_category', 'doc_category' );
        $this->insert_terms_hierarchically( 'knowledgebase_tags', 'doc_tag' );
        $this->insert_posts( 'knowledgebase', 'knowledgebase_category', 'knowledgebase_tags' );;
    }
}
