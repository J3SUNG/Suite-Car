# Suite Car

차량 내부와 외부에 센서를 부착해서 해당 데이터를 앱으로 받아서 AI를 통해 센서 데이터를 정밀화하고 <br/>
이를 앱과 웹에서 시각화 하는 작업을 한 후 사용자에게 몇 가지 선택지를 추천해 줄 수 있게 하였습니다.
<br/> <br/>

## Overview
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/7fd5849c-bd83-4b0c-a111-e64d501af387.jpg" width="400" height="250"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/00113ef3-a3db-425f-bf41-789e03b57ff5.jpg" width="400" height="250"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/589cae3e-4812-4bef-9329-1e857e5e4340.jpg" width="150" height="250"/>
<br/> <br/>

## 프로젝트 소개

Qualcomm Institute에서 주관하는 Health-related IoT Tracking Platform Challenge에 참여하게 되어 진행 된 프로젝트입니다.<br/><br/>

1. 차량 내부와 외부에 미세먼지 센서, GPS 센서를 부착, 사용자에게 심박수 센서를 부착
2. 센서로부터 받은 데이터를 데이터베이스에 저장
3. 해당 데이터를 웹과 앱에서 시각화(차트)
4. 앱에서 차량 내부와 외부의 데이터를 기반으로 운전자에게 추천 선택지를 제공
5. 운전자는 해당 선택지를 선택하면 차량에서 작동(창문 열기, 창문 닫기, 에어컨 작동, 내부 순환, 외부 순환 ... 등) (해당 사항은 아두이노로 프로토타입 제작)
<br/>

![image](https://github.com/J3SUNG/Suite-Car/assets/16315673/4bacd3e2-303f-482a-a0b0-769c2fba1bca)
<br/> <br/>
 
### 최소 요구 사항
- 소프트웨어 설계 : 레퍼런스모델 시스템아키텍쳐 프로시저디자인 플로우차트
- 주요 기능 : 
  - 유저 : 회원가입, 로그인, 로그아웃, 비밀번호 찾기, 비밀번호 변경, 회원탈퇴
  - 센서 : 센서 등록, 센서 연결, 센서 연결 해제, 센서 삭제, 센서 리스트
  - 데이터 관리 : 실시간 미세먼지 정보 전송, 실시간 사용자 건강 정보 전송
  - 데이터 시각화 : 실시간 미세먼지 정보 시각화, 실시간 사용자 건강 정보 시각화, 역대 미세먼지 정보 시각화, 역대 사용자 건강 정보 시각화

1. 센서 데이터를 AI를 통해서 정밀화
2. 센서로부터 받은 데이터를 DB에 저장
3. 해당 데이터를 기반으로 앱과 웹에 시각화
<br/> <br/>

### 개발 기간

`- 2020-01-27~2020-02-21`

### 멤버구성

- 이제성(Jeseong Lee) - FrontEnd, BackEnd, Database
- 김승수(SeungSoo Park) - FrontEnd, BackEnd, Database
- 신윤권(YunKwon Shin) - Android, Sensor
- 이정민(JungMin Lee) - AI, Arduino

### 개발환경

- Front
  - IDE : Visual Studio Code
  - Language : HTML, CSS, JavaScript
  - Framwork : BootStrap

- Back
  - IDE : Visual Studio Code
  - Language : PHP
  - Framework : Slim
  - Virtualization : vargrant
   
- Database
  - IDE : MYSQL Workbench
  - Language : MYSQL
  
- Android
  - IDE : Android Studio
  - Language : Kotlin
 
- Arduino
  - IDE : Dev C++
  - Language : C

- AI
  - Tool : KNIME

- Sensor
  - Air Quality Sensor
  - Pulse Sensor
  - GPS Sensor

### 성과
Outstanding Achievement Award 수상 <br/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/fef7fb2e-f576-407f-8f14-6b519a878450.jpg" width="600" height="400"/>


### 소프트웨어 설계

- Reference Model
- System Architecture
- Procedure Design
- Flowchart
- Database Schema
