<?php
return [
  "global"=>[
    "app_name"=>"Seed Savers Club",
    "app_tagline"=>"From seed to industry",
    "app_description"=>"India’s first end to end platform for Medicinal & Aromatic Plants.",
  ],
  "cards"=>[
    "trade_type"=>[
      "buy" => "Buy",
      "sell" => "Sell"
    ],
    "date"=>"date"
  ],
  "roles"=>[
    "input_provider"=>[
      "label"=>"Input provider",
      "activities"=>"Sell inputs to farmers"
    ],
    "farmer"=>[
      "label"=>"Farmer",
      "activities"=>"Buy inputs, Sell produce"
    ],
    "trader"=>[
      "label"=>"Aggregator",
      "activities"=>"Buy from farmers, Sell to buyers"
    ],
    "buyer"=>[
      "label"=>"Buyer",
      "activities"=>"Buy quality material"
    ],
  ],
  "login"=>[
    "phone_number_label"=>"Your whatsapp number",
    "title"=>"Let's get started",
    "button"=>"Login"
  ],
  "role_selection"=>[
    "alert"=>"Choose one of the roles above",
    "selected_roles"=>"You will be joining as"
  ],
  "profile"=>[
    "title"=>"Update your profile",
    "pic"=>"Upload picture",
    "name_label"=>[
      "individual"=>"Your name",
      "company"=>"Company/your name", 
    ],
    "name_placeholder"=>[
      "individual"=>"Thakur Singh",
      "company"=>"ABC Pvt. Ltd", 
    ],
    "address"=>[
      "label"=>"Address",
      "placeholder"=>[
        "individual"=>"Village, Tehsil, District, State",
        "company"=>"Plot no., Locality, City, State"
      ]
    ],
    "pincode"=>"Pincode",
    "business_id"=>"GSTIN/PAN no.",
    "role"=>"Role",
    "language"=>"Language",
    "button"=>"Save profile",
    "landholding"=>"Farm area",
    "landholding_unit"=>"acre(s)",
    "edit"=>"Edit profile",
    "items_heading"=>"Items",
    "items_add"=>"Add items",
    "share_button"=>"Share profile"
  ],
  "vc_selection"=>[
    "title"=>"Select which value chains you work in",
    "search"=>"Type to search",
    "selected"=>"value chains selected: "
  ],
  "actions"=>[
    "sell_input"=>[
      "label"=>"Sell inputs",
      "description"=>"Get orders from interested farmers"
    ],
    "buy_input"=>[
      "label"=>"Buy inputs",
      "description"=>"Get quality inputs"
    ],
    "sell_produce"=>[
      "label"=>"Sell produce",
      "description"=>"Get best price"
    ],
    "buy_from_farmer"=>[
      "label"=>"Buy produce",
      "description"=>"Buy from farmers"
    ],
    "sell_to_buyer"=>[
      "label"=>"Sell material",
      "description"=>"Sell to buyers"
    ],
    "buy_material"=>[
      "label"=>"Buy material",
      "description"=>"Get quality material"
    ],
  ],
  "bid-form"=>[
    "price"=>[
      "input"=>"Price",
      "produce"=>"Target price"
    ],
    "quantity"=>[
      "input"=>["sell"=>"Minimum order"],
      "produce"=>[
        "buy"=>"Required Qty",
        "sell"=>"Available Qty"
      ]
    ],
    "location"=>"Delivery location",
    "description_label"=>[
      "input"=>["sell"=>"Description"],
      "produce"=>[
        "buy"=>"Expected quality",
        "sell"=>"Description"
      ]
    ],
    "description_placeholder"=>[
      "input"=>["sell"=>"What is special about your input? Variety etc."],
      "produce"=>[
        "buy"=>"What kind of quality are you looking for? Quality parameters, variety etc.",
        "sell"=>"What is special about your material? Quality parameters, variety etc."
      ]
    ],
    "media"=>[
      "label"=>"Images/Videos",
      "button"=>"Upload files"
    ],
    "additional_info_label"=>"Additional details",
    "additional_info_placeholder"=>[
      "input"=>["sell"=>"Delivery mode, payment terms, germination guarantee etc."],
      "produce"=>[
        "buy"=>"Delivery terms, payment terms, quality deductions etc.",
        "sell"=>"Payment expectations, delivery mode"
      ]
    ],
    "button"=>[
      "input"=>["sell"=>"Add input"],
      "produce"=>[
        "buy"=>"Add demand",
        "sell"=>"Add material"
      ]
    ]
  ]
];