<?php
namespace Elementor;

function unar_elementor_init(){
    Plugin::instance()->elements_manager->add_category(
        'unar-category',
        [
            'title'  => 'Unar Addons Element',
            'icon' => 'font'
        ],
        1
    );
}
add_action('elementor/init','Elementor\unar_elementor_init');