import React, { useState } from 'react';
import { View, Text, FlatList, StyleSheet, TouchableOpacity } from 'react-native';
import { NativeStackScreenProps } from '@react-navigation/native-stack';

// Définition des types de navigation
type RootStackParamList = {
    Login: undefined;
    Dashboard: undefined;
    List: undefined;
};

type Props = NativeStackScreenProps<RootStackParamList, 'List'>;

const ListScreen: React.FC<Props> = () => {
    const data = [
        { id: 'Carbonara', title: 'Carbonara' },
        { id: 'Ramen Uzumaki', title: 'Ramen Uzumaki' },
        
    ];

    // État pour suivre l'élément sélectionné
    const [selectedItem, setSelectedItem] = useState<string | null>(null);

    return (
        <View style={styles.container}>
            <Text style={styles.title}> Liste des plats 📋</Text>

            <FlatList
                data={data}
                keyExtractor={(item) => item.id}
                renderItem={({ item }) => (
                    <TouchableOpacity
                        style={[
                            styles.listItem,
                            selectedItem === item.id && styles.selectedItem,
                        ]}
                        onPress={() => setSelectedItem(item.id)}
                    >
                        <Text style={styles.itemText}>{item.title}</Text>
                    </TouchableOpacity>
                )}
            />

            {/* Affichage du bouton Commander si un élément est sélectionné */}
            {selectedItem && (
                <TouchableOpacity style={styles.orderButton} onPress={() => alert(`Commande passée pour ${selectedItem}`)}>
                    <Text style={styles.orderButtonText}>Commander</Text>
                </TouchableOpacity>
            )}
        </View>
    );
};

const styles = StyleSheet.create({
    container: {
        flex: 1,
        padding: 20,
        backgroundColor: '#f8f8f8',
    },
    title: {
        fontSize: 24,
        fontWeight: 'bold',
        marginBottom: 20,
        textAlign: 'center',
    },
    listItem: {
        backgroundColor: '#3498db',
        padding: 15,
        marginVertical: 8,
        borderRadius: 8,
        alignItems: 'center',
    },
    selectedItem: {
        backgroundColor: '#2980b9', // Changement de couleur si sélectionné
    },
    itemText: {
        color: '#fff',
        fontSize: 18,
    },
    orderButton: {
        marginTop: 20,
        backgroundColor: '#e74c3c',
        padding: 15,
        borderRadius: 8,
        alignItems: 'center',
    },
    orderButtonText: {
        color: '#fff',
        fontSize: 18,
        fontWeight: 'bold',
    },
});

export default ListScreen;
