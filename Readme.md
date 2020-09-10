# Custom Shipping Zones Fees

This module allow you to modify the shipping fee of an order base on the zip code of the address.

## Installation

### Manually

* Copy the module into ```<thelia_root>/local/modules/``` directory and be sure that the name of the module is CustomShippingZones.
* Activate it in your thelia administration panel

### Composer

Add it in your main thelia composer.json file

```
composer require thelia/custom-shipping-zone-fees-module:~0.0.1
```

## Usage

Go to the module configuration to create a custom shipping zone and add the price and the zip codes you want.
Then go in the shipping zone of your delivery modules to add your new shipping zone.

The module will add the price of your custom shipping zone to the postage of your delivery module when the zip code of an order address is one of the zip code you specify in your custom shipping zone.


## Loop

[custom_shipping_zone_fees]

### Input arguments

|Argument |Description |
|---      |--- |
|**id** | Ids of the shipping zone you want to get. |
|**module_id** | Module id you want to filter with. |
|**without_zone** | Module id, exclude all the shipping zones attach to this module. |
|**locale** | Set local for I18n. |

### Output arguments

|Variable   |Description |
|---        |--- |
|$ID    | Id of the shipping zone |
|$FEE    | Fee of the shipping zone |
|$NAME    | Id of the shipping zone |
|$DESCRIPTION    | Id of the shipping zone |
|$ZIP_CODES    | Array of Zip code (object) |

### Exemple
    
    <table>
        <thead>
            <tr>
                <th>Zip code</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
            {loop name='my_loop' type='custom_shipping_zone_fees' locale=$locale  id=$shippingZoneId}
                {foreach $ZIP_CODES as $zipCode}
                    <tr>
                        <td>{$zipCode->getZipCode()}</td>
                        <td>{$zipCode->getCountry()->setLocale($locale)->getTitle()}</td>
                    </tr>
                {/foreach}
            {/loop}
        </tbody>
    </table>

