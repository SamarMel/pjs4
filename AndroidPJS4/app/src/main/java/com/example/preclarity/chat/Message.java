package com.example.preclarity.chat;

public class Message {
    String content;
    int idAuteur;

    public Message(String c, int id){
        content =c;
        idAuteur=id;
    }
    public String getContent(){return content;}
    public int getIdAuteur(){return idAuteur;}
}
