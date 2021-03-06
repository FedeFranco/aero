<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reservas".
 *
 * @property integer $id
 * @property integer $usuario_id
 * @property integer $vuelo_id
 * @property string $asiento
 * @property string $fecha_hora
 *
 * @property Usuarios $usuario
 * @property Vuelos $vuelo
 */
class Reserva extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public $vuel;
    public static function tableName()
    {
        return 'reservas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vuelo_id', 'asiento',], 'required'],
            [['vuelo_id'], 'integer'],
            [['asiento'], 'number'],
            [['vuel'],'safe'],
            [['vuelo_id', 'asiento'], 'unique', 'targetAttribute' => ['vuelo_id', 'asiento'], 'message' => 'The combination of Vuelo ID and Asiento has already been taken.'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_id' => 'id']],
            [['vuelo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vuelo::className(), 'targetAttribute' => ['vuelo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vuel' => 'Vuelos',
            'asiento' => 'Asiento',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'usuario_id'])->inverseOf('reservas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVuelo()
    {
        return $this->hasOne(Vuelo::className(), ['id' => 'vuelo_id'])->inverseOf('reservas');
    }
}
