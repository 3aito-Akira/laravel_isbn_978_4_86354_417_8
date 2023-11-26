<?php

return [

    'exists' => '正しい :attribute を選択してください',
    'max' => [
        'numeric' => ':attributeは:max以下を入力してください',
        'string' => ':attributeは:max文字以内で入力してください',
    ],
    'min' => [
        'numeric' => ':attributeは:min以上を入力してください',
        'string' => ':attributeは:min文字以上で入力してください',
    ],
    'numeric' => ':attributeは数値で入力してください',
    'required' => ':attributeは必ず入力してください',
    'unique' => ':attributeはすでに登録されています',

    'attributes' => [
        'category_id' => 'カテゴリ',
        'title' => 'タイトル',
        'price' => '価格',
        'author_ids' => '著者',
        'author_ids.*' => '著者',
    ],
];