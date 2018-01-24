<?php

use yii\db\Migration;

/**
 * Class m180124_221340_transactions
 */
class m180124_221340_transactions extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180124_221340_transactions cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('transactions', [
            'id' => $this->primaryKey(),
            'uid' => $this->integer()->notNull(),
            'amount' => $this->integer()->notNull(),
            'type' => "ENUM('to_card', 'to_bonus')",
            'update_time' => $this->timestamp()->notNull()
        ]);
    }

    public function down()
    {
        echo "m180124_221340_transactions cannot be reverted.\n";

        $this->dropTable('transactions');

        return false;
    }

}
