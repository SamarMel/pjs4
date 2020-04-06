package com.example.preclarity.chat;

public class Conversation {
    int idFriend;
    int idConv;

    public Conversation(int f, int i){
        idFriend = f;
        idConv = i;
    }

    public int getIdFriend(){ return idFriend;}
    public int getIdConv(){return idConv;}
}
