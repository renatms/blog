<?php

use yii\db\Migration;

/**
 * Class m200401_111211_add_date_to_comment
 */
class m200401_111211_add_date_to_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comment', 'date', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('comment', 'date');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200401_111211_add_date_to_comment cannot be reverted.\n";

        return false;
    }
    */
}
