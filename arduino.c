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
byte numbers[10] {B11111100, B01100000, B11011010, B11110010, B01100110, B10110110, B10111110, B11100000, B11111110, B11110110};

SoftwareSerial bluetooth(3, 2);
byte buffer[1024];  // 데이터 수신 버퍼
int bufferPosition; // 버퍼에 기록할 위치
String commands;

/* BYJ48 Stepper motor code Connect : IN1 >> D8 IN2 >> D9 IN3 >> D10 IN4 >> D11 VCC ... 5V Prefer to use external 5V Source Gnd */
#define IN1 7
#define IN2 8
#define IN3 11
#define IN4 13
int Steps = 0;
boolean Direction = true; // gre
unsigned long last_time;
unsigned long currentMillis ;
int steps_left = 4095;
long time;

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

  Serial.begin(115200);
  pinMode(IN1, OUTPUT);
  pinMode(IN2, OUTPUT);
  pinMode(IN3, OUTPUT);
  pinMode(IN4, OUTPUT);
  // delay(1000);

  Serial.println("Set Up");
}

void window() {
  while (steps_left > 0)
  {
    currentMillis = micros();
    if (currentMillis - last_time >= 1000)
    {
      stepper(1);
      time = time + micros() - last_time;
      last_time = micros();
      steps_left--;
    }
  }
  Serial.println(time);
  Serial.println("Wait...!");
  delay(2000);
  steps_left = 4095;
}
void stepper(int xw)
{
  for (int x = 0; x < xw; x++)
  {
    switch (Steps)
    {
      case 0:
        digitalWrite(IN1, LOW);
        digitalWrite(IN2, LOW);
        digitalWrite(IN3, LOW);
        digitalWrite(IN4, HIGH);
        break;
      case 1:
        digitalWrite(IN1, LOW);
        digitalWrite(IN2, LOW);
        digitalWrite(IN3, HIGH);
        digitalWrite(IN4, HIGH);
        break;
      case 2:
        digitalWrite(IN1, LOW);
        digitalWrite(IN2, LOW);
        digitalWrite(IN3, HIGH);
        digitalWrite(IN4, LOW);
        break;
      case 3:
        digitalWrite(IN1, LOW);
        digitalWrite(IN2, HIGH);
        digitalWrite(IN3, HIGH);
        digitalWrite(IN4, LOW);
        break;
      case 4:
        digitalWrite(IN1, LOW);
        digitalWrite(IN2, HIGH);
        digitalWrite(IN3, LOW);
        digitalWrite(IN4, LOW);
        break;
      case 5:
        digitalWrite(IN1, HIGH);
        digitalWrite(IN2, HIGH);
        digitalWrite(IN3, LOW);
        digitalWrite(IN4, LOW);
        break;
      case 6:
        digitalWrite(IN1, HIGH);
        digitalWrite(IN2, LOW);
        digitalWrite(IN3, LOW);
        digitalWrite(IN4, LOW);
        break;
      case 7:
        digitalWrite(IN1, HIGH);
        digitalWrite(IN2, LOW);
        digitalWrite(IN3, LOW);
        digitalWrite(IN4, HIGH);
        break;
      default:
        digitalWrite(IN1, LOW);
        digitalWrite(IN2, LOW);
        digitalWrite(IN3, LOW);
        digitalWrite(IN4, LOW);
        break;
    }
    SetDirection();
  }
}
void SetDirection()
{
  if (Direction == 1)
  {
    Steps++;
  }
  if (Direction == 0)
  {
    Steps--;
  }
  if (Steps > 7)
  {
    Steps = 0;
  }
  if (Steps < 0)
  {
    Steps = 7;
  }
}
void loop()
{
  t.update(); //timer update
  if (bluetooth.available())
  { // 블루투스로 데이터 수신
    t.stop(timer_event); //stop timer if anythign to read
    byte data = bluetooth.read();
    Serial.write(data); // 수신된 데이터 시리얼 모니터로 출력
    buffer[bufferPosition++] = data;
    if (data == '\n')
    { // 문자열 종료 표시를
      // 스마트폰으로 전송할 문자열을 시리얼 모니터에 출력
      Serial.print("Echo Back : ");
      Serial.write(buffer, bufferPosition);
      commands = "";
      for (char c : buffer)
        commands += c;
      bufferPosition = 0;
      int command = commands[0] - '0';
      int circulation = commands[1] - '0';
      int tens = commands[2] - '0';
      int units = commands[3] - '0';
      int temperature = tens * 10 + units;
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
        if (circulation == 0) {    
          Direction = true;
          window();
          Serial.println("Open The Window");
        } else if (circulation == 1) {
          Direction = false;
          window();
          Serial.println("Close The Window");
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
{ //scanning
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