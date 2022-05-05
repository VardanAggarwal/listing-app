<?php
return [
  "global"=>[
    "app_name"=>"Seed Savers Club - Herbal Mandi",
    "app_tagline"=>"From seed to industry",
    "app_description"=>"India’s first digital mandi for Medicinal & Aromatic Plants.",
    "units"=>[
      "rupees"=>"Rs.",
      "kg"=>"Kg",
      "qt"=>"Qt"
    ],
    "pdf"=>"Download pdf file",
    "generic_user"=>"A user"
  ],
  "cards"=>[
    "trade_type"=>[
      "buy" => "Buy",
      "sell" => "Sell"
    ],
    "count_label"=>[
      "buy"=>"sellers",
      "sell"=>"buyers"
    ],
    "date"=>"updated"
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
    "phone_number_label"=>"Your mobile number",
    "title"=>"Let's get started",
    "button"=>"Login",
    "otp_title"=>"Please verify your number with OTP",
    "selected_phone"=>"A 4 digit OTP has been sent to your phone number",
    "otp_label"=>"Enter 4 digit OTP",
    "otp_button"=>"Login",
    "number_error"=>"Something went wrong. Please check your number and try again.",
    "otp_error"=>"The OTP you entered is incorrect.",
    "resend_otp"=>"Resend OTP",
    "resend_in"=>"Resend OTP in: "
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
    "landholding"=>"Farm area",
    "landholding_unit"=>"acre(s)",
    "edit"=>"Edit profile",
    "items_heading"=>"Items",
    "message"=>[
      "share"=>"Check my profile on Herbal Mandi App. See the items I buy/sell at :url",
      "contact"=>"I saw your profile on Herbal Mandi App. :url I am interested in doing business with you."
    ],
    "button"=>[
      "share"=>"Share your profile",
      "contact"=>"Contact :name",
      "save"=>"Save profile",
    ]
  ],
  "actions"=>[
    "input_provider_sell_input"=>[
      "label"=>"Sell inputs",
      "description"=>"Get orders from interested farmers"
    ],
    "farmer_buy_input"=>[
      "label"=>"Buy inputs",
      "description"=>"Get quality inputs"
    ],
    "farmer_sell_produce"=>[
      "label"=>"Sell produce",
      "description"=>"Get best price"
    ],
    "trader_buy_produce"=>[
      "label"=>"Buy produce",
      "description"=>"Buy from farmers"
    ],
    "trader_sell_produce"=>[
      "label"=>"Sell material",
      "description"=>"Sell to buyers"
    ],
    "buyer_buy_produce"=>[
      "label"=>"Buy material",
      "description"=>"Get quality material"
    ],
    "profile_completion"=>[
      "dialog"=>"Please complete your profile so that other people can connect with you.",
      "button"=>"Complete profile"
    ]
  ],
  "bid-form"=>[
    "title"=>[
      "buy"=>"Buy :Name",
      "sell"=>"Sell :Name"
    ],
    "check_price"=>"Check prices",
    "price"=>[
      "input"=>"Price",
      "produce"=>"Target price"
    ],
    "quantity"=>[
      "input"=>[
        "sell"=>"Minimum order",
        "buy"=>"Required Qty",
    ],
      "produce"=>[
        "buy"=>"Required Qty",
        "sell"=>"Available Qty"
      ]
    ],
    "location_label"=>"Delivery location",
    "location_placeholder"=>"Delhi",
    "quality_label"=>"Quality",
    "quality_placeholder"=>"Sortex",
    "description_label"=>[
      "input"=>[
        "sell"=>"Description",
        "buy"=>"Description"
      ],
      "produce"=>[
        "buy"=>"Description",
        "sell"=>"Description"
      ]
    ],
    "description_placeholder"=>[
      "input"=>[
        "sell"=>"What is special about your input? Variety etc.",
        "buy"=>"Specific variety, soil or climate issues etc."
      ],
      "produce"=>[
        "buy"=>"What are your expectations from material? Quality parameters, variety, packaging etc.",
        "sell"=>"What is special about your material? Quality parameters, variety, packaging etc."
      ]
    ],
    "media"=>[
      "label"=>"Images/Videos",
      "button"=>"Upload files",
      "error"=>"Upload only images & videos less than 10 mb."
    ],
    "additional_info_label"=>"Additional details",
    "additional_info_placeholder"=>[
      "input"=>[
        "sell"=>"Delivery mode, payment terms, germination guarantee etc.",
        "buy"=>"Any additional details."
      ],
      "produce"=>[
        "buy"=>"Delivery terms, payment terms, quality deductions etc.",
        "sell"=>"Payment expectations, delivery mode"
      ]
    ],
    "button"=>[
      "input"=>[
        "sell"=>"Add input",
        "buy"=>"Add requirement"
    ],
      "produce"=>[
        "buy"=>"Add demand",
        "sell"=>"Add material"
      ]
    ]
  ],
  "card-group"=>[
    "heading"=>[
      "input_provider"=>[
        "sell"=>"Your inputs"
      ],
      "farmer"=>[
        "sell"=>"Sell produce",
        "buy"=>"Buy inputs"
      ],
      "trader"=>[
        "sell"=>"Market demand",
        "buy"=>"Available supply"
      ],
      "buyer"=>[
        "buy"=>"Available supply"
      ]
    ],
    "click"=>[
      "suppliers"=>[
        "sell"=>"See buyers",
        "buy"=>"See sellers",
      ],
      "input_provider"=>[
        "sell"=>"See details"
      ],
      "farmer"=>[
        "sell"=>"Sell :name",
        "buy"=>"Buy :name"
      ],
      "trader"=>[
        "sell"=>"Sell :name",
        "buy"=>"Buy :name"
      ],
      "buyer"=>[
        "buy"=>"Buy :name"
      ]
    ],
    "button"=>[
      "input_provider"=>[
        "sell"=>"List all inputs"
      ],
      "farmer"=>[
        "sell"=>"List all produce",
        "buy"=>"List inputs required"
      ],
      "trader"=>[
        "sell"=>"List items to sell",
        "buy"=>"List items to buy"
      ],
      "buyer"=>[
        "buy"=>"List items to buy"
      ]
    ],
    "last"=>"Last :days",
    "date_label"=>"What's new in: ",
    "days"=>[
      "7"=> "7 days",
      "30"=> "30 days",
      "90"=> "3 months",
      "180"=> "6 months",
      "365"=> "1 year"
    ]
  ],
  "navigation"=>[
    "input_provider"=>[
      "sell"=>"Sell inputs"
    ],
    "farmer"=>[
      "sell"=>"Market",
      "buy"=>"Inputs"
    ],
    "trader"=>[
      "sell"=>"Demand",
      "buy"=>"Supply"
    ],
    "buyer"=>[
      "buy"=>"Buy"
    ]
  ],
  "search"=>[
    "placeholder"=>"Type to search",
    "error_text"=>"Select at least one item",
    "button"=>"Continue",
    "title"=>[
      "buy"=>"Select items to buy",
      "sell"=>"Select items to sell"
    ],
    "not_found"=>"Didn't find your item? Click to add new."
  ],
  "item"=>[
    "title"=>"Add new item",
    "name"=>[
      "label"=>"Item name",
      "placeholder"=>"Ashwagandha Roots",
    ],
    "scientific_name"=>[
      "label"=>"Scientific name",
      "placeholder"=>"Withania Somnifera",
    ],
    "plant_part"=>[
      "label"=>"Plant part",
      "placeholder"=>"Roots",
    ],
    "type"=>[
      "label"=>"Item type",
      "produce"=>"Produce",
      "input"=>"Input"
    ],
    "image"=>[
      "label"=>"Item image",
      "button"=>"Upload image"
    ],
    "button"=>"Create item"
  ],
  "suppliers"=>[
    "title"=>[
      "sell"=>"Buyers for :Name",
      "buy"=>"Sellers for :Name"
    ],
    "button_action"=>[
      "new"=>"Add new :Type",
      "update"=>"See your :Type"
    ],
    "button_type"=>[
      "sell"=>"Supply",
      "buy"=>"Demand"
    ]
  ],
  "trade"=>[
    "edit"=>"Edit",
    "delete"=>"Delete",
    "trader"=>[
      "buy"=>"Buyer",
      "sell"=>"Seller"
    ],
    "trading"=>[
      "buy"=>"selling",
      "sell"=>"buying"
    ],
    "title"=>[
      "buy"=>"Buying :Name",
      "sell"=>"Selling :Name"
    ],
    "suppliers"=>[
      "buy"=>"Sellers for :name",
      "sell"=>"Buyers for :name"
    ],
    "button"=>[
      "contact"=>"Contact :trader",
      "share"=>"Share on whatsapp"
    ],
    "contact_message"=>"Hello! I got your number from Herbal Mandi App. I am interested in :trading :item as added by you here. :url",
    "share_message"=>"Hello! I am :title. Check details on Herbal Mandi App. :url",
    "request_details"=>"Request details"
  ],
  "profile_nav"=>[
    "profile"=>"Profile",
    "role"=>"Role",
    "contact"=>"Contact us",
    "logout"=>"Logout"
  ],
  "notification"=>[
    "request_details"=>[
      "title"=>":Name is requesting you to add details for :item.",
      "body"=>"Add details for :item to get noticed."
    ]
  ]
];