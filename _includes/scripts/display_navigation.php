<?php

    function displayNavigation($nav, $levels, $currDepth, $template, $class_mod){
        $output = '';
        if ($currDepth < $levels){
        $output = '<ul class="' . $class_mod . '">';
        foreach($nav as $child){
            $temp = $template;
            $classes = array();
            array_push($classes, $class_mod . '_item');
            $temp = str_replace('{item_url}', $child->getURL(), $temp);
            $temp = str_replace('{item_title}', $child->getTitle(), $temp);
            if ($child->getChildren() != null){
                $temp = str_replace('{item_subitems}', displayNavigation($child->getChildren(), $levels, $currDepth+1, $template, $class_mod), $temp);
                array_push($classes, $class_mod . '--subitems');
            } else {
                $temp = str_replace('{item_subitems}', '', $temp);
            }
            $classOut = '';
            foreach($classes as $class){
                $classOut .= $class . ' ';
            }
            $temp = str_replace("{item_class}", $classOut, $temp);
            $output .= $temp;
        }
        $output .= '</ul>';
    }
        return $output;
    
    }
?>