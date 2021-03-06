<?php
namespace App\Transformers;

use App\Policy;
use League\Fractal;
use League\Fractal\Manager;
use App\Transformers\PolicyRuleTransformer;

class PolicyTransformer extends Fractal\TransformerAbstract
{
    public function transform(Policy $policy)
    {


        return [

            'id'                        => (int) $policy->id,
            'property_id'               => (int) $policy->property_id,
            'code'                      => (string) $policy->code,
            'has_guarantee'             => (int) $policy->has_guarantee,
            'has_deposit'               => (int) $policy->has_deposit,
            'has_cancellation_penalty'  => (int) $policy->has_cancellation_penalty,
            'has_modification_penalty'  => (int) $policy->has_modification_penalty,
            'rules'                     =>  (array) $this->handleRules($policy->rules)
        ];
    }

    private function handleRules($policyRules) {
        $fractal = new Manager();
        $resource =  new Fractal\Resource\Collection($policyRules, new PolicyRuleTransformer());
        $rulesCollection  =    $fractal->createData($resource)->toArray()['data'];

        $rules  =   [];
        foreach($rulesCollection as $item) {
            $rules[$item['type']][]   =   $item;
        }

        return $rules;

    }
}
