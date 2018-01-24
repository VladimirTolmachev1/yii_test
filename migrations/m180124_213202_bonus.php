<?php

use yii\db\Migration;

/**
 * Class m180124_213202_bonus
 */
class m180124_213202_bonus extends Migration
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
        echo "m180124_213202_bonus cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('bonus', [
            'id' => $this->primaryKey(),
            'uid' => $this->integer()->notNull(),
            'amount' => $this->integer()->notNull(),
            'update_time' => $this->timestamp()->notNull()
        ]);
    }

    public function down()
    {
        echo "m180124_213202_bonus cannot be reverted.\n";

        $this->dropTable('bonus');

        return false;
    }

}
