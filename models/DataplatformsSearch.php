<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DataPlatformsForm;

/**
 * DataplatformsSearch represents the model behind the search form of `app\models\DataPlatformsForm`.
 */
class DataplatformsSearch extends DataPlatformsForm
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_platform', 'id_blogger', 'update_user_id', 'create_user_id'], 'integer'],
            [['account', 'subscribers', 'coverage', 'integration_cost', 'cpm', 'cpv', 'audience_gender', 'involvement', 'involvement_promotional_post', 'update_date', 'create_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DataPlatformsForm::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_platform' => $this->id_platform,
            'id_blogger' => $this->id_blogger,
            'update_user_id' => $this->update_user_id,
            'update_date' => $this->update_date,
            'create_user_id' => $this->create_user_id,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'subscribers', $this->subscribers])
            ->andFilterWhere(['like', 'coverage', $this->coverage])
            ->andFilterWhere(['like', 'integration_cost', $this->integration_cost])
            ->andFilterWhere(['like', 'cpm', $this->cpm])
            ->andFilterWhere(['like', 'cpv', $this->cpv])
            ->andFilterWhere(['like', 'audience_gender', $this->audience_gender])
            ->andFilterWhere(['like', 'involvement', $this->involvement])
            ->andFilterWhere(['like', 'involvement_promotional_post', $this->involvement_promotional_post]);

        return $dataProvider;
    }
}
