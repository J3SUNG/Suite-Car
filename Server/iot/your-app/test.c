#include <SoftwareSerial.h>
#include <Servo.h>
#include "Timer.h" //include timer library
#include <stdlib.h>
#include <string.h>

Timer t;         // craete a timer object
long number = 0; //declear the variables
int first_digit = 0;
int second_digit = 0;
int third_digit = 0;
int fourth_digit = 0;
int timer_event = 0;

int CA_1 = 12;
int CA_2 = 11;
int CA_3 = 10;
int CA_4 = 9;
int clk = 6;
int latch = 5;
int data = 4;
int count = 0;
int digits[4];
int CAS[4] = {12, 11, 10, 9};
byte numbers[10]{B11111100, B01100000, B11011010, B11110010, B01100110, B10110110, B10111110, B11100000, B11111110, B11110110};

SoftwareSerial bluetooth(3, 2);
byte buffer[1024];  // 데이터 수신 버퍼
int bufferPosition; // 버퍼에 기록할 위치
String commands;

Servo windowMoter;
char daehyun;
int motor = 7;

void setup()
{
    Serial.begin(9600);
    bluetooth.begin(9600);
    pinMode(CA_1, OUTPUT);
    pinMode(CA_2, OUTPUT);
    pinMode(CA_3, OUTPUT);
    pinMode(CA_4, OUTPUT);
    pinMode(clk, OUTPUT);
    pinMode(latch, OUTPUT);
    pinMode(data, OUTPUT);
    digitalWrite(CA_1, HIGH);
    digitalWrite(CA_2, HIGH);
    digitalWrite(CA_3, HIGH);
    digitalWrite(CA_4, HIGH);

    windowMoter.attach(motor); 
    /*
  pinMode(latch2,OUTPUT);
  pinMode(clock2,OUTPUT);
  pinMode(data2,OUTPUT);*/

    Serial.println("What the Fork");
}
void loop()
{
    t.update(); //timer update
    if (bluetooth.available())
    {                        // 블루투스로 데이터 수신
        t.stop(timer_event); //stop timer if anythign to read
        byte data = bluetooth.read();
        Serial.write(data); // 수신된 데이터 시리얼 모니터로 출력
        buffer[bufferPosition++] = data;
        if (data == '\n')
        { // 문자열 종료 표시를
            buffer[bufferPosition] = '\0';
            // 스마트폰으로 전송할 문자열을 시리얼 모니터에 출력
            Serial.print("Echo Back : ");
            Serial.write(buffer, bufferPosition);
            for (char c : buffer)
                commands += c;
            Serial.print(commands);
            bufferPosition = 0;
            int command = commands[0] - '0';
            int circulation = commands[1] - '0';
            int tens = commands[2] - '0';
            int units = commands[3] - '0';
            int temperature = tens * 10 + units;

            Serial.print(tens);
            if (command == 0)
            {
                int numberToDisplay = circulation * 1000 + temperature;
                Serial.println("numberToDisplay");
                Serial.println(numberToDisplay);
                display(numberToDisplay);
                //선풍기돌려돌려돌림판
            }
            else if (command == 1)
            {
                if(circulation==0){
                    //창문을 열어버렷
                    windowMoter.write(90);
                }else if(circulation==1){
                    //창문을 닫아버렷
                    windowMoter.write(0);
                }
            }
        }
    }
}

void display(int number)
{
    if (number > 9999)
    { //check the number is 0-9999
        Serial.println("Please Enter Number Between 0 - 9999");
    }
    else
    {
        break_number(number);
        timer_event = t.every(1, display_number); // start timer again
    }
}
void break_number(long num)
{ // seperate the input number into 4 single digits
    first_digit = num / 1000;
    digits[0] = first_digit;

    int first_left = num - (first_digit * 1000);
    second_digit = first_left / 100;
    digits[1] = second_digit;
    int second_left = first_left - (second_digit * 100);
    third_digit = second_left / 10;
    digits[2] = third_digit;
    fourth_digit = second_left - (third_digit * 10);
    digits[3] = fourth_digit;
}

void display_number()
{                                                          //scanning
    cathode_high();                                        //black screen
    digitalWrite(latch, LOW);                              //put the shift register to read
    shiftOut(data, clk, LSBFIRST, numbers[digits[count]]); //send the data
    digitalWrite(CAS[count], LOW);                         //turn on the relevent digit
    digitalWrite(latch, HIGH);                             //put the shift register to write mode
    count++;                                               //count up the digit
    if (count == 4)
    { // keep the count between 0-3
        count = 0;
    }
}

void cathode_high()
{ //turn off all 4 digits
    digitalWrite(CA_1, HIGH);
    digitalWrite(CA_2, HIGH);
    digitalWrite(CA_3, HIGH);
    digitalWrite(CA_4, HIGH);
}