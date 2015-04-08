(function(require){
require.config({"baseUrl":"http://dev.magento2.local/pub/static/frontend/Magento/luma/en_US"});
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    paths: {
        'store/template': 'Magento_Store/templates'
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        "*": {
            "rowBuilder":             "Magento_Theme/js/row-builder",
            "toggleAdvanced":         "mage/toggle",
            "translateInline":        "mage/translate-inline",
            "sticky":                 "mage/sticky",
            "tabs":                   "mage/tabs",
            "zoom":                   "mage/zoom",
            "gallery":                "mage/gallery",
            "galleryFullScreen":      "mage/gallery-fullscreen",
            "collapsible":            "mage/collapsible",
            "dropdownDialog":         "mage/dropdown",
            "dropdown":               "mage/dropdowns",
            "accordion":              "mage/accordion",
            "loader":                 "mage/loader",
            "tooltip":                "mage/tooltip",
            "deletableItem":          "mage/deletable-item",
            "itemTable":              "mage/item-table",
            "fieldsetControls":       "mage/fieldset-controls",
            "fieldsetResetControl":   "mage/fieldset-controls",
            "redirectUrl":            "mage/redirect-url",
            "loaderAjax":             "mage/loader",
            "menu":                   "mage/menu",
            "popupWindow":            "mage/popup-window",
            "validation":             "mage/validation/validation"
        }
    },
    paths: {
        "jquery/ui": "jquery/jquery-ui"
    },
    deps: [
        "jquery/jquery.mobile.custom",
        "js/responsive",
        "mage/common",
        "mage/dataPost",
        "js/theme",
        "mage/bootstrap"
    ]
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    "waitSeconds": 0,
    "shim": {
        "jquery/jquery-migrate": ["jquery"],
        "jquery/jquery.hashchange": ["jquery", "jquery/jquery-migrate"],
        "jquery/jstree/jquery.hotkeys": ["jquery"],
        "jquery/hover-intent": ["jquery"],
        "mage/adminhtml/backup": ["prototype"],
        "mage/captcha": ["prototype"],
        "mage/common": ["jquery"],
        "mage/requirejs/plugin/id-normalizer": ["jquery"],
        "mage/webapi": ["jquery"],
        "jquery/ui": ["jquery"],
        "tinymce": {
            "exports": "tinymce"
        },
        "ko": {
            "exports": "ko"
        },
        "moment": {
            "exports": "moment"
        },
        "matchMedia": {
            "exports": "mediaCheck"
        }
    },
    "paths": {
        "jquery/validate": "jquery/jquery.validate",
        "jquery/hover-intent": "jquery/jquery.hoverIntent",
        "jquery/file-uploader": "jquery/fileUploader/jquery.fileupload-fp",
        "jquery/jquery.hashchange": "jquery/jquery.ba-hashchange.min",
        "prototype": "legacy-build.min",
        "text": "requirejs/text",
        "domReady": "requirejs/domReady",
        "ko": "ko/ko",
        "tinymce": "tiny_mce/tiny_mce_src"
    },
    "deps": [
        "jquery/jquery-migrate"
    ]
};

require(['jquery'], function ($) {
    $.noConflict();
});

require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            checkoutBalance:    'Magento_Customer/js/checkout-balance',
            address:            'Magento_Customer/address',
            setPassword:        'Magento_Customer/set-password'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            quickSearch: 'Magento_Search/form-mini'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            compareItems:           'Magento_Catalog/js/compare',
            compareList:            'Magento_Catalog/js/list',
            relatedProducts:        'Magento_Catalog/js/related-products',
            upsellProducts:         'Magento_Catalog/js/upsell-products',
            productListToolbarForm: 'Magento_Catalog/js/product/list/toolbar',
            tierPrice:              'Magento_Catalog/js/tier-price',
            catalogGallery:         'Magento_Catalog/js/gallery',
            priceBox:               'Magento_Catalog/js/price-box',
            priceOptionDate:        'Magento_Catalog/js/price-option-date',
            priceOptionFile:        'Magento_Catalog/js/price-option-file',
            priceOptions:           'Magento_Catalog/js/price-options',
            priceUtils:             'Magento_Catalog/js/price-utils',
            catalogAddToCart:       'Magento_Catalog/js/catalog-add-to-cart'
        }
    }
};

require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            creditCardType: 'Magento_Payment/cc-type'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            addToCart: 'Magento_Msrp/js/msrp'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            requireCookie: 'Magento_Cookie/js/require-cookie',
            cookieNotices: 'Magento_Cookie/js/notices'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            bundleOption:   'Magento_Bundle/bundle',
            priceBundle:    'Magento_Bundle/js/price-bundle',
            slide:          'Magento_Bundle/js/slide',
            productSummary: 'Magento_Bundle/js/product-summary'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            downloadable: 'Magento_Downloadable/downloadable'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            giftMessage:    'Magento_Sales/gift-message',
            ordersReturns:  'Magento_Sales/orders-returns'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            giftOptions:    'Magento_GiftMessage/gift-options',
            extraOptions:   'Magento_GiftMessage/extra-options'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            discountCode:           'Magento_Checkout/js/discount-codes',
            orderOverview:          'Magento_Checkout/js/overview',
            shoppingCart:           'Magento_Checkout/js/shopping-cart',
            regionUpdater:          'Magento_Checkout/js/region-updater',
            opcOrderReview:         'Magento_Checkout/js/opc-order-review',
            sidebar:                'Magento_Checkout/js/sidebar',
            payment:                'Magento_Checkout/js/payment',
            paymentAuthentication:  'Magento_Checkout/js/payment-authentication'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            configurable: 'Magento_ConfigurableProduct/js/configurable'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            multiShipping: 'Magento_Multishipping/js/multi-shipping'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            pageCache:  'Magento_PageCache/js/page-cache'
        }
    }
};

require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            centinelAuthenticate: 'Magento_Centinel/centinel-authenticate'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            captcha: 'Magento_Captcha/captcha'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            recentlyViewedProducts: 'Magento_Reports/js/recently-viewed'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            catalogSearch: 'Magento_CatalogSearch/form-mini'
        }
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    paths: {
        'ui/template': 'Magento_Ui/templates',
        'i18n': 'Magento_Ui/js/lib/i18n'
    }
};
require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        "*": {
            "taxToggle": "Magento_Weee/tax-toggle"
        }
    }
};

require.config(config);
})();
(function() {
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            wishlist:       'Magento_Wishlist/wishlist',
            addToWishlist:  'Magento_Wishlist/js/add-to-wishlist',
            wishlistSearch: 'Magento_Wishlist/js/search'
        }
    }
};
require.config(config);
})();



})(require);