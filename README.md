# Suite Car

차량 내부와 외부에 센서를 부착해서 해당 데이터를 앱으로 받아서 AI를 통해 센서 데이터를 정밀화하고 이를 앱과 웹에서 시각화 하는 작업을 합니다. <br/>
내부와 외부 센서 데이터를 통해서 사용자에게 효율적인 선택지를 추천해주며, 사용자가 선택하면 차량이 해당 기능을 하게 하였습니다.(아두이노로 대체)
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

![Reference Model drawio](https://github.com/J3SUNG/Suite-Car/assets/16315673/6b916ea0-5005-49cd-b065-7ddea530d47a)
<br/><br/>

- System Architecture

![System Architecture drawio](https://github.com/J3SUNG/Suite-Car/assets/16315673/1fc7ce30-4c13-4ece-a233-765100294c9f)
<br/><br/>

- Procedure Design
 
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/a5787658-0944-42ce-a34c-88351b367199.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/53f357c4-3a6a-4d42-bdfe-d8ddc90419a7.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/7d5ac82c-788d-4853-ac50-021ce70d70d5.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/169a680c-3866-46f0-aef1-7e8fa01a4b8d.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/0c5ddc26-a33e-47a6-a89a-994b6d3277e0.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/003b0231-cc7b-43d1-a240-8a1f4dec3a7f.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/92261356-1a57-4b6f-8810-17bbf70c90c6.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/c22ed227-2328-48e4-b650-5a567e95ff1f.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/3f355ecb-f5cb-482f-890d-989e5fe5b214.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/beaff07f-4c07-47cc-9907-b6921490aa05.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/66dd0e4a-4f70-4d50-bff2-3ef59de7d708.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/e9fe911a-786b-4d07-9daf-208f1132996d.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/eea80955-74ba-4cae-bbc1-aae5d8434014.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/4d5b6b79-f9fd-4f02-ac8f-326025968f4c.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/5e1c3eec-fbc7-462e-9e1a-1a639a05228c.jpg" width="200" height="400"/>
<br/><br/>

- Flowchart

<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/e33dda3f-644f-4bdb-a6c1-492c345db6ff.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/882d646c-7654-4d06-ba94-a2beb5866d0c.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/04af2666-a35a-4aa4-8e41-9f9526b4967c.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/5728fc7c-9bcf-4e02-b340-bb6d6d279bd1.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/9a47e453-b1ea-47c1-9907-346545930925.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/a273926a-e2a1-49b4-82a6-45d191d0a34e.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/fed39af9-3bd0-4108-9024-792bc0df7d9d.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/928a0f06-68e1-41a1-871c-39de07b95ac0.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/82047a21-e86e-4f81-8529-731befd051d8.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/17c42112-b82f-4ef2-9d57-8affb4466974.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/b26a4c2a-7305-4fef-b782-4d362f3d685f.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/37455d37-68f9-447e-ad8b-f8fbb85fc951.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/c34ec500-b11a-4333-9b07-b1293f38c6c8.jpg" width="200" height="400"/>
<img src="https://github.com/J3SUNG/Suite-Car/assets/16315673/c1b58ab2-b72d-453a-b6b2-754b78c29dbc.jpg" width="200" height="400"/>
<br/><br/>

- Database Schema

![Database Schema](https://github.com/J3SUNG/Suite-Car/assets/16315673/fa45f1fd-dfd7-4b28-955d-0410ede16660)
<br/><br/>

### 주요기능
- User
  - sign in
  - sign out
  - sign up
  - user password change
  - forgotten password
  - id cancellation
  
- Sensor
  - registration
  - deregistration
  - association
  - deassociation
  - list

- Data
  - realtime air quality data view
  - realtime heart-related data view
  - historical air quality data view
  - historical heart-related data view
