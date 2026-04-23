<?php

class Script extends CI_Controller {



    public function index() {
       $pr=$this->db->where('id>=','1165')->get('products_old')->result();
       foreach ($pr as $p){
           $id=$p->id;
           $data=array(
               'sku'=>$p->sku,
               'product_type'=>$p->product_type,
               'user_id'=>$p->user_id,
               'category_id'=>$p->category_id,
               'subcategory_id'=>$p->subcategory_id,
               'childcategory_id'=>$p->childcategory_id,
               'attributes'=>$p->attributes,
               'name'=>$p->name,
               'slug'=>$p->slug,
               'photo'=>$p->photo,
               'thumbnail'=>$p->thumbnail,
               'file'=>$p->file,
               'size'=>$p->size,
               'size_qty'=>$p->size_qty,
               'size_price'=>$p->size_price,
               'color'=>$p->color,
               'add_photo_color'=>$p->add_photo_color,
               'price'=>$p->price,
               'previous_price'=>$p->previous_price,
               'details'=>$p->details,
               'stock'=>$p->stock,
               'policy'=>$p->policy,
               'status'=>$p->status,
               'views'=>$p->views,
               'tags'=>$p->tags,
               'features'=>$p->features,
               'colors'=>$p->colors,
               'product_condition'=>$p->product_condition,
               'ship'=>$p->ship,
               'is_meta'=>$p->is_meta,
               'meta_tag'=>$p->meta_tag,
               'meta_description'=>$p->meta_description,
               'youtube'=>$p->youtube,
               'type'=>$p->type,
               'license'=>$p->license,
               'license_qty'=>$p->license_qty,
               'link'=>$p->link,
               'platform'=>$p->platform,
               'region'=>$p->region,
               'licence_type'=>$p->licence_type,

               'measure'=>$p->measure,
               'minimum_quantity'=>$p->minimum_quantity,
               'minimum_qty_type'=>$p->minimum_qty_type,
               'weight'=>$p->weight,
               'weight_unit'=>$p->weight_unit,
               'length'=>$p->length,
               'width'=>$p->width,
               'height'=>$p->height,
               'cubic_meter'=>$p->cubic_meter,
               'supply_ability'=>$p->supply_ability,
               'payment_term'=>$p->payment_term,
               'supply_option'=>$p->supply_option,
               'sample_check'=>$p->sample_check,
               'sample_policy'=>$p->sample_policy,
               'export_market'=>$p->export_market,
               'featured'=>$p->featured,
               'best'=>$p->best,
               'top'=>$p->top,
               'hot'=>$p->hot,
               'latest'=>$p->latest,
               'big'=>$p->big,
               'sale'=>$p->sale,
               'created_at'=>$p->created_at,

               'updated_at'=>$p->updated_at,
               'is_discount'=>$p->is_discount,
               'discount_date'=>$p->discount_date,
               'whole_sell_qty'=>$p->whole_sell_qty,
               'whole_sell_discount'=>$p->whole_sell_discount,
               'is_catalog'=>$p->is_catalog,
               'catalog_id'=>$p->catalog_id,
           );
           $this->db->insert('products1',$data);
           $new_id=$this->db->insert_id();
           $iddata=array(
               'product_id'=>$new_id
           );
           $this->db->where('product_id',$id)->update('galleries',$iddata);

       }
    }

}
