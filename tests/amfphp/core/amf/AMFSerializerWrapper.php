<?php

/**
 * This class exports some internal (public) methods. This way, those methods
 * can be tested separately.
 */

class AmfSerializerWrapper extends Amfphp_Core_Amf_Serializer
{
    public function writeByte($b){
        parent::writeByte($b);
    }

    public function writeInt($n) {
        parent::writeInt($n);
    }

    public function writeLong($l) {
        parent::writeLong($l);
    }

    public function writeUtf($s) {
        parent::writeUtf($s);
    }
    public function writeDouble($s) {
        parent::writeDouble($s);
    }

    public function writeLongUtf($s) {
        parent::writeLongUtf($s);
    }

    public function writeNumber($d) {
        parent::writeNumber($d);
    }

    public function writeBoolean($d) {
        parent::writeBoolean($d);
    }

    public function writeString($d) {
        parent::writeString($d);
    }

    public function writeXML($d) {
        parent::writeXML($d);
    }

    public function writeDate($d) {
        parent::writeDate($d);
    }

    public function writeNull() {
        parent::writeNull();
    }

    public function writeUndefined() {
        parent::writeUndefined();
    }

    public function writeObjectEnd() {
        parent::writeObjectEnd();
    }

    public function writeArray($d) {
        parent::writeArray($d);
    }

    public function writeReference($d) {
        parent::writeReference($d);
    }

    public function writeTypedObject($d) {
        parent::writeTypedObject($d);
    }

    public function writeAmf3Data(&$d)
    {
        return parent::writeAmf3Data($d);
    }

    public function writeAmf3Null()
    {
        return parent::writeAmf3Null();
    }

    public function writeAmf3Undefined()
    {
        return parent::writeAmf3Undefined();
    }


    public function writeAmf3Bool($d)
    {
        return parent::writeAmf3Bool($d);
    }


    public function writeAmf3Number($d)
    {
        return parent::writeAmf3Number($d);
    }


    public function writeAmf3String($d, $raw = FALSE)
    {
        return parent::writeAmf3String($d, $raw);
    }


    public function writeAmf3Xml($d)
    {
        return parent::writeAmf3Xml($d);
    }


    public function writeAmf3Array(/* array */ $d, $arrayCollectionable = FALSE)
    {
        return parent::writeAmf3Array($d, $arrayCollectionable);
    }

    public function writeAmf3Object(/* object */ $d)
    {
        return parent::writeAmf3Object($d);
    }

    public function writeAmf3ByteArray(/* ByteArray */ $d)
    {
        return parent::writeAmf3ByteArray($d);
    }


}
?>