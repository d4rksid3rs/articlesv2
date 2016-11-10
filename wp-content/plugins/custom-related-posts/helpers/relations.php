<?php

class CRP_Relations {

	private $relations_from = array();
	private $relations_to = array();

    public function __construct()
    {
    }

    public function add_relation( $base_id, $target_id, $from, $to )
    {
        $base = get_post( $base_id );
        $target = get_post( $target_id );

        $post_types = CustomRelatedPosts::option( 'general_post_types', array( 'post', 'page' ) );

        if( $base_id !== $target_id && is_object( $base ) && is_object( $target ) && in_array( $base->post_type, $post_types ) && in_array( $target->post_type, $post_types ) ) {
            $base_data = $this->get_data( $base );
            $target_data = $this->get_data( $target );

            // Current Relations
            $base_relations_from = $this->get_from( $base_id );
            $base_relations_to = $this->get_to( $base_id );
            $target_relations_from = $this->get_from( $target_id );
            $target_relations_to = $this->get_to( $target_id );

            if( $from ) {
                $base_relations_from[$target_id] = $target_data;
                $target_relations_to[$base_id] = $base_data;

                $this->update_to( $target_id, $target_relations_to );
                $this->update_from( $base_id, $base_relations_from );
            }

            if( $to ) {
                $base_relations_to[$target_id] = $target_data;
                $target_relations_from[$base_id] = $base_data;

                $this->update_to( $base_id, $base_relations_to );
                $this->update_from( $target_id, $target_relations_from );
            }
        }
    }

    public function remove_relation( $base_id, $target_id, $from, $to )
    {
        $base = get_post( $base_id );
        $target = get_post( $target_id );

        $post_types = CustomRelatedPosts::option( 'general_post_types', array( 'post', 'page' ) );

        if( $base_id !== $target_id && is_object( $base ) && is_object( $target ) && in_array( $base->post_type, $post_types ) && in_array( $target->post_type, $post_types ) ) {

            // Current Relations
            $base_relations_from = CustomRelatedPosts::get()->relations_from( $base_id );
            $base_relations_to = CustomRelatedPosts::get()->relations_to( $base_id );
            $target_relations_from = CustomRelatedPosts::get()->relations_from( $target_id );
            $target_relations_to = CustomRelatedPosts::get()->relations_to( $target_id );

            if( $from ) {
                unset( $base_relations_from[$target_id] );
                unset( $target_relations_to[$base_id] );

                $this->update_to( $target_id, $target_relations_to );
                $this->update_from( $base_id, $base_relations_from );
            }

            if( $to ) {
                unset( $base_relations_to[$target_id] );
                unset( $target_relations_from[$base_id] );

                $this->update_to( $base_id, $base_relations_to );
                $this->update_from( $target_id, $target_relations_from );
            }
        }
    }

    public function get_data( $post )
    {
        if( !is_object( $post ) ) $post = get_post( $post );

        return array(
            'title' => $post->post_title,
            'permalink' => get_permalink( $post ),
            'status' => $post->post_status,
            'date' => $post->post_date,
        );
    }

    public function get_from( $post_id )
    {
//        delete_post_meta_by_key( 'crp_relations_from' );
//        delete_post_meta_by_key( 'crp_relations_to' );
	    if( !array_key_exists( $post_id, $this->relations_from ) ) {
		    $relations = get_post_meta( $post_id, 'crp_relations_from', true );
		    if( !$relations ) $relations = array();

		    $this->relations_from[$post_id] = $relations;
	    }

	    return $this->relations_from[$post_id];
    }

	public function get_to( $post_id )
	{
		if( !array_key_exists( $post_id, $this->relations_to ) ) {
			$relations = get_post_meta( $post_id, 'crp_relations_to', true );
			if( !$relations ) $relations = array();

			$this->relations_to[$post_id] = $relations;
		}

		return $this->relations_to[$post_id];
	}

    public function update_from( $post_id, $relations )
    {
        $this->relations_from[$post_id] = $relations;
        update_post_meta( $post_id, 'crp_relations_from', $relations );
    }

    public function update_to( $post_id, $relations )
    {
        $this->relations_from[$post_id] = $relations;
        update_post_meta( $post_id, 'crp_relations_to', $relations );
    }
}