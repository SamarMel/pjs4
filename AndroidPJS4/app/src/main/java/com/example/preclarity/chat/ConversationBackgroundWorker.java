package com.example.preclarity.chat;

import android.os.AsyncTask;

import com.example.preclarity.Forum.Topic;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.List;

public class ConversationBackgroundWorker extends AsyncTask<Integer, Void, List<Message>> {
    @Override
    protected List<Message> doInBackground(Integer... integers) {
        List<Message> messages = new ArrayList<Message>();
        Integer idConv = integers[0];
        String login_url="http://pjs4.ulyssebouchet.fr/Android/Messages.php";
        String result="";
        try {
            URL url = new URL(login_url);
            HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
            httpURLConnection.setRequestMethod("POST");
            httpURLConnection.setDoOutput(true);
            httpURLConnection.setDoInput(true);
            OutputStream outputStream = httpURLConnection.getOutputStream();
            BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
            String post_data = URLEncoder.encode("idConv","UTF-8")+"="+URLEncoder.encode(String.valueOf(idConv),"UTF-8");
            bufferedWriter.write(post_data);
            bufferedWriter.flush();
            bufferedWriter.close();
            outputStream.close();
            InputStream inputStream = httpURLConnection.getInputStream();
            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream,"iso-8859-1"));
            // String result="";
            String line="";
            while((line = bufferedReader.readLine())!= null) {
                result += line;
            }
            bufferedReader.close();
            inputStream.close();
            httpURLConnection.disconnect();

        } catch (MalformedURLException e) {
            //Log.w(TAG, "Malformated EXCEPTIOOOOOOOON");
        } catch (IOException e) {
            //Log.w(TAG, "IO EXCEPTIOOOOOOOON");
        }

        try {
            String s="";
            JSONArray jArray = new JSONArray(result);
            for(int i =0; i<jArray.length();i++){
                JSONObject json = jArray.getJSONObject(i);
                String content = json.getString("content");
                int idAuteur = json.getInt("idAuteur");
                messages.add((new Message(content,idAuteur)));


            }
            return messages;
            // TopicAdapter adapter = new TopicAdapter(context, lastTopics);

        } catch (JSONException e) {
            e.printStackTrace();
        }
        return null;
    }
}
