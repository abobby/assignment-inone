<?php
function buildHierarchy($flattened_data) {
    $roots = array();
    $look_up = array();
    foreach($flattened_data as $row) {
        $id = $row['id'];
        $parent_id = $row['parent'];

        $entry = $row;
        if(isset($look_up[$id]['children'])) {
            $entry['children'] = &$look_up[$id]['children'];
        }

        // root nodes has parent id 0
        if ($parent_id === 0) {
            $roots[] = &$entry;
        } else {
            if(!isset($look_up[$parent_id]['children'])) {
                $look_up[$parent_id]['children'] = [];
            }
            $look_up[$parent_id]['children'][] = &$entry;
        }
        $look_up[$id] = &$entry;
        unset($entry);
    }
    return $roots;
}
$datafolder = 'data/';
$flattened_data = file_get_contents($datafolder.'flattened.json');
$parsed_data = json_decode($flattened_data, true);
$hierarchical_structure = buildHierarchy($parsed_data);
$hierarchical_json = json_encode($hierarchical_structure, JSON_PRETTY_PRINT);
file_put_contents($datafolder.'hierarchical.json', $hierarchical_json);
echo "<center><h2>Json generated in data folder</h2></center>";
