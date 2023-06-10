<?php

namespace App\Actions\User;

use App\Actions\Action;
use Illuminate\Support\Arr;

class UpdatePreferenceAction extends Action
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'user.id' => ['integer','required'],
            'sources' => ['array'],
            'sources.*' => ['string'],
            'categories' => ['array'],
            'categories.*' => ['integer']
        ];
    }

    /**
     * @return int
     */
    public function execute(): int
    {
        $pref = $this->data['user']->preference ?? [];
        $pref['categories'] = Arr::get($this->data,'categories', []);
        $pref['sources'] = Arr::get($this->data,'sources', []);

//        $pref = $this->data['user']->preference;
//        if($this->data['action'] === 'remove'){
//            array_splice($pref, array_search($this->data['preference'], $pref), 1);
//        }else{
//            $pref[] = $this->data['preference'];
//        }
        return $this->data['user']->update([
            'preference' => $pref,
        ]);
    }
}
