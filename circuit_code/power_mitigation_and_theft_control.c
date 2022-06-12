#include <SoftwareSerial.h>
SoftwareSerial SIM900A(10,11);

const int analogInput = A1;
int a=0;
int buzzer = 5;

void setup() {
  Serial.begin(9600);
  pinMode(analogInput, INPUT);
  pinMode(buzzer, OUTPUT);

  SIM900A.begin(9600);   // Setting the baud rate of GSM Module  
  Serial.begin(9600);    // Setting the baud rate of Serial Monitor (Arduino)
  delay(100);
  //Serial.println ("Type s to send message or r to receive message");
}

void loop(){
  Serial.print("Current:");
  Serial.print(getCurrent());  
  Serial.print(" "); 
  Serial.print("Voltage:");
  Serial.println(getVoltage(),2);
  delay(500);

  float value= (getVoltage(),2);

  if(getVoltage()<=1){  
    Serial.println ("SIM900A Ready");
    digitalWrite(buzzer,HIGH);    
      SendMessage();
      a=1;
  }  
  else 
  {
    digitalWrite(buzzer,LOW);
  }
  if (SIM900A.available()>0)
   Serial.write(SIM900A.read());
}

void SendMessage()
{
  Serial.println ("Sending Message");
  SIM900A.println("AT+CMGF=1");    //Sets the GSM Module in Text Mode
  delay(1000);
  //Serial.println ("Set SMS Number");
  SIM900A.println("AT+CMGS=\"+917395971053\"\r"); //Mobile phone number to send message
  delay(1000);
  Serial.println ("Set SMS Content: There is a problem in your current setup");
  SIM900A.println("There is a problem in your current setup");// Messsage content
  delay(100);
  //Serial.println ("Finish");
  SIM900A.println((char)26);// ASCII code of CTRL+Z
  delay(1000);
  Serial.println ("Message has been sent");
}

float getCurrent() {    
  float average = 0;
  for(int i = 0; i < 1000; i++) {
    average = average + (.0264 * analogRead(A0) -13.385) / 1000;//this is 
    //for the 5A mode, if 20A or 30A mode, need to modify this formula to 
    //(.19 * analogRead(A0) -25) for 20A mode and 
    //(.044 * analogRead(A0) -3.78) for 30A mode
    delay(1);
  }
return average;
}

float getVoltage() {
   const float R1 = 30000.0; //  
   const float R2 = 7500.0; // 
   float value = analogRead(analogInput);
   float vout = (value * 5.0) / 1024.0; // see text
   float vin = vout / (R2/(R1+R2)); 
  return vin;
}