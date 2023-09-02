<?php
use PHPUnit\Framework\TestCase;

require_once 'path-to-your-modelFetchData.php';

class modelFetchDataTest extends TestCase
{
    public function testFetchDataFromAdminSuccess()
    {
        $mockConnection = $this->getMockBuilder('mysqli')
            ->disableOriginalConstructor()
            ->getMock();
        $mockConnection->expects($this->once())
            ->method('prepare')
            ->willReturn(true);
        $model = new modelFetchData();
        $model->setConnection($mockConnection);
        $expectedResult = [
            [
                'id' => 1,
                'userId' => 101,
                'email' => 'user1@stu.ibu.edu.ba',
                'date' => '2023-09-03',
                'startTime' => '10:00',
                'endTime' => '11:00',
                'room_number' => 123,
            ],
        ];

        $result = $model->fetchDataFromAdmin();
        $this->assertEquals($expectedResult, $result);
    }

    public function testFetchDataFromAdminFailure()
    {
        $mockConnection = $this->getMockBuilder('mysqli')
            ->disableOriginalConstructor()
            ->getMock();

        $mockConnection->expects($this->once())
            ->method('prepare')
            ->willReturn(true);
        $model = new modelFetchData();
        $model->setConnection($mockConnection);

        $mockStatement = $this->getMockBuilder('mysqli_stmt')
            ->disableOriginalConstructor()
            ->getMock();

        $mockStatement->expects($this->once())
            ->method('execute')
            ->willReturn(false);

        $mockConnection->expects($this->once())
            ->method('prepare')
            ->willReturn($mockStatement);

        $result = $model->fetchDataFromAdmin();

        $this->assertNull($result);
    }
}

?>
