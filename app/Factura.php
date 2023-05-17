<?php
use App\FacturaContrato;
namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    //
    protected $fillable = [
        'cliente_id', 'user_id','empresa_id','factura_num','tipo_comprobante','fecha_hora',
        'impuesto','total','esta_paga','nota',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facturas';
    //Relacion con contratos
    public function contratos(){
        return $this->belongsToMany(Contrato::class);   
    }
    //Relacion con empresas
    public function empresa(){
        return $this->belongsTo('App\Empresa');   
    }
   //Relacion con productos
   public function productos()
   {
       return $this->belongsToMany(Producto::class);
   }
   //Relacion uno a muchos
   public function factura_producto()
   {
       return $this->hasMany(FacturaProducto::class);
   }
   public function user()
   {
       return $this->belongsTo(User::class);
   }




}
