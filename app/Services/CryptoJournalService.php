<?php
namespace App\Services;
use App\Models\CryptoJournal;
class CryptoJournalService
{
    // find all News
    public static function getCrypto()
    {
        return CryptoJournal::orderby('id','desc')->paginate(10);
    }
    // delete country
    public static function deleteCrypto($newsId) 
    {
        $news = CryptoJournal::find($newsId);
        $news->delete();
    }
    //find country by id
    public static function getCryptoById($categoryId)
    {
        return CryptoJournal::find($categoryId);
    }
    //insert or update Crypto
    public static function createCrypto($newsDetails,$newsId)
    {
        if($newsId== 0)
        {
            return CryptoJournal::create($newsDetails);
        }
        else
        {
            return CryptoJournal::whereId($newsId)->update($newsDetails);
        }
    }
}
?>