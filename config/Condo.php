<?php

return [
    'types' => [
        [
            'id' => 'notice',
            'label' => 'Avviso',
            'color' => 'bg-blue-400',
        ],
        [
            'id' => 'work',
            'label' => 'Lavori',
            'color' => 'bg-gray-400',
        ],
        [
            'id' => 'meeting',
            'label' => 'Riunione',
            'color' => 'bg-red-400',
        ],
    ],
    'priorities' => [
        [
            'id' => 'low',
            'label' => 'Bassa',
            'color' => 'bg-green-400',
        ],
        [
            'id' => 'medium',
            'label' => 'Media',
            'color' => 'bg-orange-400',
        ],
        [
            'id' => 'high',
            'label' => 'Alta',
            'color' => 'bg-red-400',
        ],
    ],
    'categories' => [
        [
            'id' => 'meeting',
            'label' => 'Riunione',
            'color' => 'bg-green-400  text-white',
        ],
        [
            'id' => 'payments',
            'label' => 'Pagamenti',
            'color' => 'bg-red-400  text-white',
        ],
        [
            'id' => 'call',
            'label' => 'Telefonata',
            'color' => 'bg-blue-400  text-white',
        ],
        [
            'id' => 'vidcall',
            'label' => 'Videocall',
            'color' => 'bg-slate-400 text-white',
        ],
        [
            'id' => 'other',
            'label' => 'Altro',
            'color' => 'bg-black text-white',
        ],
    ],
];
