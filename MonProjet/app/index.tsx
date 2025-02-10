import { router } from 'expo-router';
import React, { useState } from 'react';
import { View, Text, TextInput, TouchableOpacity, StyleSheet, Alert } from 'react-native';

const LoginScreen = () => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [isRegistering, setIsRegistering] = useState(false); // Pour afficher le formulaire d'inscription
    const [name, setName] = useState('');

    const handleLogin = async () => {
        // Simulation d'une connexion réussie
        Alert.alert("Succès", "Connexion réussie !");
        router.push("/ListScreen");
    };

    const handleRegister = () => {
        if (!name || !email || !password) {
            Alert.alert("Erreur", "Veuillez remplir tous les champs");
            return;
        }
        Alert.alert("Succès", "Inscription réussie !");
        setIsRegistering(false); // Retour à l'écran de connexion après inscription
    };

    return (
        <View style={styles.container}>
            {isRegistering ? (
                // Formulaire d'inscription
                <>
                    <Text style={styles.title}>Inscription</Text>
                    
                    <TextInput
                        style={styles.input}
                        placeholder="Nom"
                        autoCapitalize="words"
                        value={name}
                        onChangeText={setName}
                    />

                    <TextInput
                        style={styles.input}
                        placeholder="Email"
                        keyboardType="email-address"
                        autoCapitalize="none"
                        value={email}
                        onChangeText={setEmail}
                    />

                    <TextInput
                        style={styles.input}
                        placeholder="Mot de passe"
                        secureTextEntry
                        value={password}
                        onChangeText={setPassword}
                    />

                    <TouchableOpacity style={styles.button} onPress={handleRegister}>
                        <Text style={styles.buttonText}>S'inscrire</Text>
                    </TouchableOpacity>

                    <TouchableOpacity onPress={() => setIsRegistering(false)}>
                        <Text style={styles.link}>Retour à la connexion</Text>
                    </TouchableOpacity>
                </>
            ) : (
                // Formulaire de connexion
                <>
                    <Text style={styles.title}>Connexion</Text>

                    <TextInput
                        style={styles.input}
                        placeholder="Email"
                        keyboardType="email-address"
                        autoCapitalize="none"
                        value={email}
                        onChangeText={setEmail}
                    />

                    <TextInput
                        style={styles.input}
                        placeholder="Mot de passe"
                        secureTextEntry
                        value={password}
                        onChangeText={setPassword}
                    />

                    <TouchableOpacity style={styles.button} onPress={handleLogin}>
                        <Text style={styles.buttonText}>Se connecter</Text>
                    </TouchableOpacity>

                    <TouchableOpacity onPress={() => setIsRegistering(true)}>
                        <Text style={styles.link}>S’inscrire</Text>
                    </TouchableOpacity>
                </>
            )}
        </View>
    );
};

const styles = StyleSheet.create({
    container: {
        flex: 1,
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: '#f5f5f5',
        padding: 20,
    },
    title: {
        fontSize: 24,
        fontWeight: 'bold',
        marginBottom: 20,
    },
    input: {
        width: '100%',
        height: 50,
        backgroundColor: '#fff',
        borderRadius: 8,
        paddingHorizontal: 10,
        marginBottom: 15,
        elevation: 2,
    },
    button: {
        width: '100%',
        height: 50,
        backgroundColor: '#3498db',
        justifyContent: 'center',
        alignItems: 'center',
        borderRadius: 8,
    },
    buttonText: {
        color: '#fff',
        fontSize: 18,
        fontWeight: 'bold',
    },
    link: {
        marginTop: 15,
        color: '#3498db',
        fontSize: 16,
    },
});

export default LoginScreen;
