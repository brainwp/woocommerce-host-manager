<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04/08/14
 * Time: 18:33
 */
require_once plugin_dir_path( __FILE__ ) . '/odin-metabox.php' ;
$_meta = new WC_Host_Manager_Metabox(
    'wc-host-manager-meta', // Metabox slug
    __('Opções de recorrência - Host Manager','wc-host-manager'), // Metabox name
    'product', // post type
    'normal',
    'high'
);
$_meta->set_fields(
    array(
        /**
         * set options in post
         */
        array(
           'id'          => 'wc-host-manager-meta-before', // Obrigatório
           'label'       => __( 'Tempo antes do vencimento', 'wc-host-manager' ), // Obrigatório
           'type'        => 'text', // Obrigatório
           'default'     => '355', // Opcional
           'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
           	   'min' => '1',
           	   'type' => 'number',
           	),
           'description' => __( '<br>Digite quantos dias depois de pago será enviado o email de cobrança (Antes do vencimento)', 'wc-host-manager' ), // Opcional
        ),
        array(
           'id'          => 'wc-host-manager-meta-after', // Obrigatório
           'label'       => __( 'Tempo depois do vencimento', 'wc-host-manager' ), // Obrigatório
           'type'        => 'text', // Obrigatório
           'default'     => '395', // Opcional
           'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
           	   'min' => '1',
           	   'type' => 'number',
           	),
           'description' => __( '<br>Digite quantos dias depois de pago será enviado o email de cobrança (Depois do vencimento)', 'wc-host-manager' ), // Opcional
        ),
        array(
           'id'          => 'wc-host-manager-meta-del', // Obrigatório
           'label'       => __( 'Tempo de cancelamento', 'wc-host-manager' ), // Obrigatório95
           'type'        => 'text', // Obrigatório
           'default'     => '425', // Opcional
           'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
           	   'min' => '1',
           	   'type' => 'number',
           	),
           'description' => __( '<br>Digite quantos dias depois de pago será enviado o email de cancelamento (Depois do vencimento)', 'wc-host-manager' ), // Opcional
        ),
    )
);
