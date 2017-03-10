<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vuelos".
 *
 * @property integer $id
 * @property string $id_vuelo
 * @property integer $orig_id
 * @property integer $dest_id
 * @property integer $comp_id
 * @property string $salida
 * @property string $llegada
 * @property string $plazas
 * @property string $precio
 *
 * @property Reservas[] $reservas
 * @property Aeropuertos $orig
 * @property Aeropuertos $dest
 * @property Companias $comp
 */
class Vuelo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vuelos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orig_id', 'dest_id', 'comp_id', 'salida', 'llegada', 'plazas', 'precio'], 'required'],
            [['orig_id', 'dest_id', 'comp_id'], 'integer'],
            [['salida', 'llegada'], 'safe'],
            [['plazas', 'precio'], 'number'],
            [['id_vuelo'], 'string', 'max' => 6],
            [['id_vuelo'], 'unique'],
            [['orig_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aeropuerto::className(), 'targetAttribute' => ['orig_id' => 'id']],
            [['dest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aeropuerto::className(), 'targetAttribute' => ['dest_id' => 'id']],
            [['comp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Compania::className(), 'targetAttribute' => ['comp_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_vuelo' => 'Id Vuelo',
            'orig_id' => 'Orig ID',
            'dest_id' => 'Dest ID',
            'comp_id' => 'Comp ID',
            'salida' => 'Salida',
            'llegada' => 'Llegada',
            'plazas' => 'Plazas',
            'precio' => 'Precio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reserva::className(), ['vuelo_id' => 'id'])->inverseOf('vuelo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrigen()
    {
        return $this->hasOne(Aeropuerto::className(), ['id' => 'orig_id'])->inverseOf('vuelos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestino()
    {
        return $this->hasOne(Aeropuerto::className(), ['id' => 'dest_id'])->inverseOf('vuelos0');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompania()
    {
        return $this->hasOne(Compania::className(), ['id' => 'comp_id'])->inverseOf('vuelos');
    }

    public function getUsuariosVuelo()
    {
        $usurs = [];
        $max = sizeof( $this->reservas);

        for ($i=0; $i < $max; $i++) {
            $usurs[] = $this->reservas[$i]->usuario->nombre;
        }

        return implode(",",$usurs);
    }
}
